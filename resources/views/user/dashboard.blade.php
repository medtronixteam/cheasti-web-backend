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
        .fc-event-dark {
            background-color: #343a40;
            color: #fff;
        }

        .fc-event-success {
            background-color: #28a745;
            color: #fff;
        }

        .fc-event-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .fc-event-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .fc-event-info {
            background-color: #17a2b8;
            color: #fff;
        }

        .tooltip-content {
            display: flex;
            align-items: center;
        }

        .tooltip-content i {
            margin-right: 8px;
        }
    </style>
@endpush
@section('title')
    Dashboard
@endsection

@section('content')
    <div class="row gy-4">
        <!-- Gamification Card -->
        <div class="col-md-12 col-lg-8">
            <div class="card h-100">
                <div class="d-flex align-items-end row">
                    <div class="col-md-6 order-2 order-md-1">
                        <div class="card-body">
                            @if (auth()->check())
                                @if (auth()->user()->is_plan_active == true)
                                    <h4 class="card-title pb-xl-2"> <span
                                            class="text-primary">{{ auth()->user()->first_name }}
                                            {{ auth()->user()->last_name }}</span></h4>

                                    <p class=" badge bg-label-dark">You have subcription the <span
                                            style="font-weight: 800">{{ auth()->user()->current_plan }}</span> plan.</p>
                                @else
                                    <h4 class="card-title pb-xl-2"> <span
                                            class="text-primary">{{ auth()->user()->first_name }}
                                            {{ auth()->user()->last_name }}</span> </h4>

                                    <p class="badge bg-label-secondary">No active subscription plan.</p>
                                @endif
                                {{-- @else --}}
                            @endif
                            <br>
                            <a href="{{ route('user.subscription') }}" class="btn btn-primary">subscription</a>

                        </div>
                    </div>
                    <div class="col-md-6 text-center text-md-end order-1 order-md-2">
                        <div class="card-body pb-0 px-0 px-md-4 ps-0">
                            <img src="{{ url('assets/img/illustrations/illustration-john-light.png') }}" height="180"
                                alt="View Profile" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-wrap">
                        <div class="avatar me-4">
                            <div class="avatar-initial bg-label-primary rounded-3">
                                <i class="fa fa-note-sticky">
                                </i>
                            </div>
                        </div>
                        <div class="card-info">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0 me-2" style="font-weight: 800">{{ $totalNotes }}</h5>

                            </div>
                            <p class="mb-0">Total Notes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card app-calendar-wrapper mt-4">
        <div class="row g-0">

            <!-- Buttons for Daily, Weekly View, and Reload -->
            <div class="col-12 text-center mt-3">
                {{-- <button id="dailyViewBtn" class="btn btn-primary">Daily View</button>
                <button id="weeklyViewBtn" class="btn btn-secondary">Weekly View</button> --}}
                {{-- <button id="reloadBtn" class="btn btn-info">Full View</button> --}}
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
    <div class="row g-0 mt-4">

        @if (isset($remainingDays) && $remainingDays >= 0)
            <div class="col-lg-4">
                <div class="card ">

                    <div class="card-body">
                        <div class="bg-label-primary p-4 rounded-4 my-3">
                            <div class="d-flex">
                                <div
                                    class="border border-1 border-primary rounded me-4 p-2 d-flex align-items-center justify-content-center w-px-40 h-px-40">
                                    <i class="fa fa-pie-chart"></i>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">

                                        <p class="badge bg-label-success mt-2">Days Left in Subscription</p>
                                    </div>
                                    <div class="user-progress">
                                        <div class="d-flex justify-content-center">

                                            <h2 class="fw-medium mb-0">{{ $remainingDays }}</h2>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @elseif(isset($remainingDays) && $remainingDays < 0)
                <div class="card">

                    <div class="card-body">
                        <div class="bg-label-primary p-4 rounded-4 my-3">
                            <div class="d-flex">
                                <div
                                    class="border border-1 border-primary rounded me-4 p-2 d-flex align-items-center justify-content-center w-px-40 h-px-40">
                                    <i class="fa fa-pie-chart"></i>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">

                                    </div>
                                    <div class="user-progress">
                                        <div class="d-flex justify-content-center">

                                            <p class="badge bg-label-dark mt-2">Subscription has expired</p>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        @endif
        {{-- Events and Tasks d-none --}}

        <div class="col-sm-6 col-lg-4 card d-none ">
            <div class="card-body h-100 d-flex align-items-center justify-content-center flex-wrap flex-column">
                <div class="avatar me-4">
                    <div class="avatar-initial bg-label-primary rounded-3">
                        <i class="fa-2x fa fa-calendar">
                        </i>
                    </div>
                </div>
                <div class="card-info">
                    <div class="d-flex align-items-center">
                        <a class="btn btn-primary my-3" href="{{ route('user.calendar') }}">Events and Tasks</a>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('js')
    <script src="{{ url('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script src="{{ url('assets/vendor/libs/fullcalendar/fullcalendar.js') }}"></script>
    <!-- FormValidation -->
    <script src="{{ url('assets/vendor/libs/@form-validation/umd/bundle/popular.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/@form-validation/umd/bundle/bootstrap5.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/@form-validation/umd/bundle/auto-focus.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/select2/select2.js') }}"></script>

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

        document.addEventListener('DOMContentLoaded', function() {
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
                            duration: {
                                days: 7
                            },
                            buttonText: 'Weekly'
                        }
                    },
                    eventClassNames: function({
                        event
                    }) {
                        const platform = event.extendedProps.calendar.toLowerCase() || 'other';
                        return ["fc-event-" + (eventLabels[platform] || eventLabels.other)];
                    },
                    eventDidMount: function(info) {
                        var tooltipContent = document.createElement('div');
                        tooltipContent.classList.add('tooltip-content');
                        const platform = info.event.extendedProps.platforms[0]?.toLowerCase() ||
                        'other';
                        tooltipContent.innerHTML =
                            `<p>${platformIcons[platform]}<br> </p> ${info.event.title}<br>${info.event.start.toLocaleString()}<br>${info.event.extendedProps.description}`;

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
