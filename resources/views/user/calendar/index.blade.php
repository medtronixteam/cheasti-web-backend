@extends('layouts.app')
@push('css')
<!-- FullCalendar -->
<link rel="stylesheet" href="{{ url('assets/vendor/libs/fullcalendar/fullcalendar.css') }}">

<!-- Flatpickr -->
<link rel="stylesheet" href="{{ url('assets/vendor/libs/flatpickr/flatpickr.css') }}">

<!-- Select2 -->
<link rel="stylesheet" href="{{ url('assets/vendor/libs/select2/select2.css') }}">
<style>
    .light-style .flatpickr-calendar {
        box-shadow: none;
    }
</style>
<style>
    .fc-event-dark { background-color: #343a40; color: #fff; }
    .fc-event-success { background-color: #28a745; color: #fff; }
    .fc-event-danger { background-color: #dc3545; color: #fff; }
    .fc-event-warning { background-color: #ffc107; color: #212529; }
    .fc-event-info { background-color: #17a2b8; color: #fff; }
    .tooltip-content {
        display: flex;
        align-items: center;
    }
    .tooltip-content i {
        margin-right: 8px;
    }
</style>
@endpush

@section('content')
<div class="card app-calendar-wrapper">
    <div class="row g-0">

        <!-- Buttons for Daily, Weekly View, and Reload -->
        <div class="col-12 text-center mt-3">
            <button id="dailyViewBtn" class="btn btn-primary">Daily View</button>
            <button id="weeklyViewBtn" class="btn btn-secondary">Weekly View</button>
            <button id="reloadBtn" class="btn btn-info">Full View</button>
        </div>

        <!-- Calendar & Modal -->
        <div class="col app-calendar-content mt-3">
            <div class="card shadow-none border-0">
                <div class="card-body pb-0">
                    <!-- FullCalendar -->
                    <div id="calendar"></div>
                </div>
            </div>
            <div class="app-overlay"></div>
        </div>
        <!-- /Calendar & Modal -->
    </div>
</div>
@endsection

@push('js')

<script src="{{url('assets/vendor/libs/moment/moment.js')}}"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
<script src="{{url('assets/vendor/libs/fullcalendar/fullcalendar.js')}}"></script>
<!-- FormValidation -->
<script src="{{ url('assets/vendor/libs/@form-validation/umd/bundle/popular.js') }}"></script>
<script src="{{ url('assets/vendor/libs/@form-validation/umd/bundle/bootstrap5.js') }}"></script>
<script src="{{ url('assets/vendor/libs/@form-validation/umd/bundle/auto-focus.js') }}"></script>
<script src="{{url('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{url('assets/vendor/libs/select2/select2.js')}}"></script>

<script>
    window.events = [
        @foreach ($contents as $content)
        {
            id: "{{ $content->video_id }}",
            title: "{{ $content->title }}",
            start: "{{ $content->scheduled_at }}",
            end: "{{ $content->scheduled_at }}", // Assuming the event lasts only one day
            allDay: true,
            extendedProps: {
                description: "{{ $content->description }}",
                calendar: "{{ optional($content->category)->name ?: 'Security' }}",
                tags: "{{ $content->tags }}",
                caption: "{{ $content->caption }}",
                platforms: {!! json_encode(json_decode($content->platforms)) !!},
                status: "{{ $content->status }}",
                user_id: "{{ $content->user_id }}"
            }
        },
        @endforeach
        @foreach ($notes as $note)
        {
            id: "note-{{ $note->note_id }}",
            title: "Note: {{ $note->note_name }}",
            start: "{{ $note->creation_date }}",
            allDay: true,
            extendedProps: {
                description: "{{ $note->note }}",
                calendar: "Notes",
                user_id: "{{ $note->user_id }}",
                platforms: ["notes"],
            }
        },
        @endforeach
        @foreach ($todos as $todo)
        {
            id: "todo-{{ $todo->todo_id }}",
            title: "Todo: {{ $todo->task }}",
            start: "{{ $todo->due_date }}",
            allDay: true,
            extendedProps: {
                description: "{{ $todo->task }}",
                calendar: "Todos",
                user_id: "{{ $todo->user_id }}",
                is_completed: "{{ $todo->is_completed }}",
                platforms: ["todos"],

            }
        },
        @endforeach
    ];

    const eventLabels = {
        tiktok: "dark",
        facebook: "success",
        youtube: "danger",
        instagram: "warning",
        notes: "info",
        todos: "primary",
        other: "secondary"
    };

    const platformIcons = {
        tiktok: '<i class="fab fa-tiktok"></i><br>',
        facebook: '<i class="fab fa-facebook"></i><br>',
        youtube: '<i class="fab fa-youtube"></i><br>',
        instagram: '<i class="fab fa-instagram"></i><br>',
        notes: '<i class="fas fa-sticky-note"></i><br>',
        todos: '<i class="fas fa-check"></i><br>',
        other: '<i class="fas fa-info-circle"></i><br>'
    };

    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar;

        function initializeCalendar() {
            if (calendar) {
                calendar.destroy();
            }

            calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    start: 'prev,next today',
                    center: 'title',
                    end: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                events: window.events,
                views: {
                    customWeeklyView: {
                        type: 'timeGrid',
                        duration: { days: 7 },
                        buttonText: 'Weekly'
                    }
                },
                eventClassNames: function({ event }) {
                    const platform = event.extendedProps.calendar.toLowerCase() || 'other';
                    return ["fc-event-" + (eventLabels[platform] || eventLabels.other)];
                },
                eventDidMount: function(info) {
                    var tooltipContent = document.createElement('div');
                    tooltipContent.classList.add('tooltip-content');
                    const platform = info.event.extendedProps.platforms[0]?.toLowerCase() || 'other';
                    tooltipContent.innerHTML = `<p>${platformIcons[platform]}<br> </p> ${info.event.title}<br>${info.event.start.toLocaleString()}<br>${info.event.extendedProps.description}`;

                    var tooltip = new bootstrap.Tooltip(info.el, {
                        title: tooltipContent.outerHTML,
                        html: true,
                        placement: 'top',
                        trigger: 'hover'
                    });
                },
                eventClick: function(info) {
                    // Additional actions on event click
                },
                datesSet: function() {
                    customizeCalendarButtons();
                },
                viewDidMount: function() {
                    customizeCalendarButtons();
                }
            });

            calendar.render();
            customizeCalendarButtons();
        }

        function customizeCalendarButtons() {
            const prevButton = document.querySelector(".fc-prev-button"),
                nextButton = document.querySelector(".fc-next-button"),
                todayButton = document.querySelector(".fc-today-button");

            prevButton.classList.add("btn", "btn-sm", "btn-icon", "btn-outline-secondary", "me-2");
            nextButton.classList.add("btn", "btn-sm", "btn-icon", "btn-outline-secondary", "me-2");
            todayButton.classList.add("btn", "btn-sm", "btn-icon", "btn-outline-secondary", "me-2");
        }

        initializeCalendar();

        document.getElementById('dailyViewBtn').addEventListener('click', function() {
            calendar.changeView('timeGridDay');
        });

        document.getElementById('weeklyViewBtn').addEventListener('click', function() {
            calendar.changeView('customWeeklyView');
            calendar.today();
        });

        document.getElementById('reloadBtn').addEventListener('click', function() {
            initializeCalendar();
        });
    });
</script>


@endpush
