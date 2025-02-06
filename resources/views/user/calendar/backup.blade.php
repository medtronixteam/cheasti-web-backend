@extends('layouts.app')
@push('css')
<!-- FullCalendar -->
<link rel="stylesheet" href="{{ url('assets/vendor/libs/fullcalendar/fullcalendar.css') }}">

<!-- Flatpickr -->
<link rel="stylesheet" href="{{ url('assets/vendor/libs/flatpickr/flatpickr.css') }}">

<!-- Select2 -->
<link rel="stylesheet" href="{{ url('assets/vendor/libs/select2/select2.css') }}">
<style>
    .light-style .flatpickr-calendar{
        box-shadow: none;
    }
</style>
@endpush

@section('content')
<div class="card app-calendar-wrapper">
    <div class="row g-0">
        <!-- Calendar Sidebar -->
        <div class="col-12 col-md-4 app-calendar-sidebar border-end" id="app-calendar-sidebar">
            <div class="p-5 my-sm-0 mb-4 border-bottom">
                <button class="btn btn-primary btn-toggle-sidebar w-100" data-bs-toggle="offcanvas"
                    data-bs-target="#addEventSidebar" aria-controls="addEventSidebar">
                    <i class="ri-add-line ri-16px me-1_5"></i>
                    <span class="align-middle">Add Event</span>
                </button>
            </div>
            <div class="px-4">
                <!-- inline calendar (flatpicker) -->
                <div class="inline-calendar"></div>

                <hr class="mb-5 mx-n4 mt-3">
                <!-- Filter -->
                <div class="mb-4 ms-1">
                    <h5>Event Filters</h5>
                </div>

                <div class="form-check form-check-secondary mb-5 ms-3">
                    <input class="form-check-input select-all" type="checkbox" id="selectAll" data-value="all" checked>
                    <label class="form-check-label" for="selectAll">View All</label>
                </div>

                <div class="app-calendar-events-filter text-heading">
                    <div class="form-check form-check-danger mb-5 ms-3">
                        <input class="form-check-input input-filter" type="checkbox" id="select-personal"
                            data-value="personal" checked>
                        <label class="form-check-label" for="select-personal">Personal</label>
                    </div>
                    <div class="form-check mb-5 ms-3">
                        <input class="form-check-input input-filter" type="checkbox" id="select-business"
                            data-value="business" checked>
                        <label class="form-check-label" for="select-business">Business</label>
                    </div>
                    <div class="form-check form-check-warning mb-5 ms-3">
                        <input class="form-check-input input-filter" type="checkbox" id="select-family"
                            data-value="family" checked>
                        <label class="form-check-label" for="select-family">Family</label>
                    </div>
                    <div class="form-check form-check-success mb-5 ms-3">
                        <input class="form-check-input input-filter" type="checkbox" id="select-holiday"
                            data-value="holiday" checked>
                        <label class="form-check-label" for="select-holiday">Holiday</label>
                    </div>
                    <div class="form-check form-check-info ms-3">
                        <input class="form-check-input input-filter" type="checkbox" id="select-etc" data-value="etc"
                            checked>
                        <label class="form-check-label" for="select-etc">ETC</label>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Calendar Sidebar -->

        <!-- Calendar & Modal -->
        <div class="col app-calendar-content">
            <div class="card shadow-none border-0 ">
                <div class="card-body pb-0">
                    <!-- FullCalendar -->
                    <div id="calendar"></div>
                </div>
            </div>
            <div class="app-overlay"></div>
            <!-- FullCalendar Offcanvas -->
            <div class="offcanvas offcanvas-end event-sidebar" tabindex="-1" id="addEventSidebar"
                aria-labelledby="addEventSidebarLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title" id="addEventSidebarLabel">Add Event</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form class="event-form pt-0" id="eventForm" onsubmit="return false">
                        <div class="form-floating form-floating-outline mb-5">
                            <input type="text" class="form-control" id="eventTitle" name="eventTitle"
                                placeholder="Event Title" />
                            <label for="eventTitle">Title</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-5">
                            <select class="select2 select-event-label form-select" id="eventLabel" name="eventLabel">
                                <option data-label="primary" value="Business" selected>Business</option>
                                <option data-label="danger" value="Personal">Personal</option>
                                <option data-label="warning" value="Family">Family</option>
                                <option data-label="success" value="Holiday">Holiday</option>
                                <option data-label="info" value="ETC">ETC</option>
                            </select>
                            <label for="eventLabel">Label</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-5">
                            <input type="text" class="form-control" id="eventStartDate" name="eventStartDate"
                                placeholder="Start Date" />
                            <label for="eventStartDate">Start Date</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-5">
                            <input type="text" class="form-control" id="eventEndDate" name="eventEndDate"
                                placeholder="End Date" />
                            <label for="eventEndDate">End Date</label>
                        </div>
                        <div class="mb-5">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input allDay-switch" id="allDaySwitch" />
                                <label class="form-check-label" for="allDaySwitch">All Day</label>
                            </div>
                        </div>
                        <div class="form-floating form-floating-outline mb-5">
                            <input type="url" class="form-control" id="eventURL" name="eventURL"
                                placeholder="https://www.google.com" />
                            <label for="eventURL">Event URL</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-5 select2-primary">
                            <select class="select2 select-event-guests form-select" id="eventGuests" name="eventGuests"
                                multiple>
                                <option data-avatar="1.png" value="Jane Foster">Jane Foster</option>
                                <option data-avatar="3.png" value="Donna Frank">Donna Frank</option>
                                <option data-avatar="5.png" value="Gabrielle Robertson">Gabrielle Robertson</option>
                                <option data-avatar="7.png" value="Lori Spears">Lori Spears</option>
                                <option data-avatar="9.png" value="Sandy Vega">Sandy Vega</option>
                                <option data-avatar="11.png" value="Cheryl May">Cheryl May</option>
                            </select>
                            <label for="eventGuests">Add Guests</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-5">
                            <input type="text" class="form-control" id="eventLocation" name="eventLocation"
                                placeholder="Enter Location" />
                            <label for="eventLocation">Location</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-5">
                            <textarea class="form-control" name="eventDescription" id="eventDescription"></textarea>
                            <label for="eventDescription">Description</label>
                        </div>
                        <div class="mb-5 d-flex justify-content-sm-between justify-content-start my-6 gap-2">
                            <div class="d-flex">
                                <button type="submit" class="btn btn-primary btn-add-event me-4">Add</button>
                                <button type="reset" class="btn btn-outline-secondary btn-cancel me-sm-0 me-1"
                                    data-bs-dismiss="offcanvas">Cancel</button>
                            </div>
                            <button class="btn btn-outline-danger btn-delete-event d-none">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
        <!-- /Calendar & Modal -->
    </div>
</div>

@endsection


@push('js')

<script src="{{url('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{url('assets/vendor/libs/fullcalendar/fullcalendar.js')}}"></script>
<!-- FormValidation -->
<script src="{{ url('assets/vendor/libs/@form-validation/umd/bundle/popular.js') }}"></script>
<script src="{{ url('assets/vendor/libs/@form-validation/umd/bundle/bootstrap5.js') }}"></script>
<script src="{{ url('assets/vendor/libs/@form-validation/umd/bundle/auto-focus.js') }}"></script>
<script src="{{url('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{url('assets/vendor/libs/select2/select2.js')}}"></script>
<script>
    let textDirection = "ltr";
    if (isRtl) {
        textDirection = "rtl";
    }
    document.addEventListener("DOMContentLoaded", function() {
        (function() {
            // Get references to DOM elements
            const calendarElement = document.getElementById("calendar"), // Main calendar container
                calendarSidebar = document.querySelector(".app-calendar-sidebar"), // Sidebar for calendar
                addEventSidebar = document.getElementById("addEventSidebar"), // Sidebar for adding events
                overlayElement = document.querySelector(".app-overlay"), // Overlay element
                eventLabels = { // Mapping of event labels to their corresponding colors
                    Business: "primary",
                    Holiday: "success",
                    Personal: "danger",
                    Family: "warning",
                    ETC: "info"
                },
                sidebarTitle = document.querySelector(".offcanvas-title"), // Title element in the sidebar
                toggleSidebarButton = document.querySelector(".btn-toggle-sidebar"), // Button to toggle the sidebar
                submitButton = document.querySelector('button[type="submit"]'), // Submit button in the form
                deleteEventButton = document.querySelector(".btn-delete-event"), // Button to delete an event
                cancelButton = document.querySelector(".btn-cancel"), // Button to cancel event addition/update
                eventTitleInput = document.querySelector("#eventTitle"), // Input field for event title
                eventStartDateInput = document.querySelector("#eventStartDate"), // Input field for event start date
                eventEndDateInput = document.querySelector("#eventEndDate"), // Input field for event end date
                eventURLInput = document.querySelector("#eventURL"), // Input field for event URL
                eventLabelSelect = $("#eventLabel"), // Select element for event labels
                eventGuestsSelect = $("#eventGuests"), // Select element for event guests
                eventLocationInput = document.querySelector("#eventLocation"), // Input field for event location
                eventDescriptionInput = document.querySelector("#eventDescription"), // Input field for event description
                allDaySwitch = document.querySelector(".allDay-switch"), // Switch for all-day events
                selectAllFiltersCheckbox = document.querySelector(".select-all"), // Checkbox to select all filters
                filterInputs = [].slice.call(document.querySelectorAll(".input-filter")), // Array of filter inputs
                inlineCalendar = document.querySelector(".inline-calendar"); // Inline calendar element

            // Initialize variables
            let currentEvent, // Reference to the current event being edited
                eventList = events, // List of events
                formValid = false, // Flag to track form validity
                inlineCalendarInstance; // Instance of the inline calendar

            // Initialize offcanvas for adding events
            const offcanvasInstance = new bootstrap.Offcanvas(addEventSidebar);
        
            // Initialize select2 for event label selection if available
            if (eventLabelSelect.length) {
                // Define a function to format the label options
                let formatLabel = function(option) {
                    if (!option.id) return option.text;
                    var labelHTML = "<span class='badge badge-dot bg-" + $(option.element).data("label") + " me-2'> </span>" + option.text;
                    return labelHTML;
                };
                // Focus on select2 element and wrap it
                select2Focus(eventLabelSelect);
                eventLabelSelect.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Select value",
                    dropdownParent: eventLabelSelect.parent(),
                    templateResult: formatLabel,
                    templateSelection: formatLabel,
                    minimumResultsForSearch: -1,
                    escapeMarkup: function(markup) {
                        return markup
                    }
                })
            }

            // Initialize select2 for event guests selection if available
            if (eventGuestsSelect.length) {
                // Define a function to format the guest options
                let formatGuests = function(option) {
                    if (!option.id) return option.text;
                    var guestHTML = "<div class='d-flex flex-wrap align-items-center'><div class='avatar avatar-xs me-2'><img src='" + assetsPath + "img/avatars/" + $(option.element).data("avatar") + "' alt='avatar' class='rounded-circle' /></div>" + option.text + "</div>";
                    return guestHTML;
                };
                // Focus on select2 element and wrap it
                select2Focus(eventGuestsSelect);
                eventGuestsSelect.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Select value",
                    dropdownParent: eventGuestsSelect.parent(),
                    closeOnSelect: false,
                    templateResult: formatGuests,
                    templateSelection: formatGuests,
                    escapeMarkup: function(markup) {
                        return markup
                    }
                })
            }

            // Initialize flatpickr for event start date input if available
            if (eventStartDateInput) {
                var startDatePicker = eventStartDateInput.flatpickr({
                    enableTime: true,
                    altFormat: "Y-m-dTH:i:S",
                    onReady: function(selectedDates, dateStr, instance) {
                        if (instance.isMobile) {
                            instance.mobileInput.setAttribute("step", null);
                        }
                    }
                });
            }

            // Initialize flatpickr for event end date input if available
            if (eventEndDateInput) {
                var endDatePicker = eventEndDateInput.flatpickr({
                    enableTime: true,
                    altFormat: "Y-m-dTH:i:S",
                    onReady: function(selectedDates, dateStr, instance) {
                        if (instance.isMobile) {
                            instance.mobileInput.setAttribute("step", null);
                        }
                    }
                });
            }

            // Initialize flatpickr for inline calendar if available
            if (inlineCalendar) {
                inlineCalendarInstance = inlineCalendar.flatpickr({
                    monthSelectorType: "static",
                    inline: true
                });
            }

            // Function to handle click on a calendar event
            function handleEventClick(eventInfo) {
                currentEvent = eventInfo.event;
                // If the event has a URL, open it in a new tab
                if (currentEvent.url) {
                    eventInfo.jsEvent.preventDefault();
                    window.open(currentEvent.url, "_blank");
                }
                // Show the event sidebar
                offcanvasInstance.show();
                // Update sidebar title
                if (sidebarTitle) {
                    sidebarTitle.innerHTML = "Update Event";
                }
                // Update submit button label and class
                submitButton.innerHTML = "Update";
                submitButton.classList.add("btn-update-event");
                submitButton.classList.remove("btn-add-event");
                // Show delete event button
                deleteEventButton.classList.remove("d-none");
                // Populate event details in the form fields
                eventTitleInput.value = currentEvent.title;
                startDatePicker.setDate(currentEvent.start, true, "Y-m-d");
                allDaySwitch.checked = currentEvent.allDay;
                if (currentEvent.end !== null) {
                    endDatePicker.setDate(currentEvent.end, true, "Y-m-d");
                } else {
                    endDatePicker.setDate(currentEvent.start, true, "Y-m-d");
                }
                eventLabelSelect.val(currentEvent.extendedProps.calendar).trigger("change");
                if (currentEvent.extendedProps.location !== undefined) {
                    eventLocationInput.value = currentEvent.extendedProps.location;
                }
                if (currentEvent.extendedProps.guests !== undefined) {
                    eventGuestsSelect.val(currentEvent.extendedProps.guests).trigger("change");
                }
                if (currentEvent.extendedProps.description !== undefined) {
                    eventDescriptionInput.value = currentEvent.extendedProps.description;
                }
            }

            // Function to customize calendar buttons
            function customizeCalendarButtons() {
                const sidebarToggleButton = document.querySelector(".fc-sidebarToggle-button"),
                    prevButton = document.querySelector(".fc-prev-button"),
                    nextButton = document.querySelector(".fc-next-button"),
                    headerToolbar = document.querySelector(".fc-header-toolbar");
                // Add Bootstrap classes to calendar navigation buttons
                prevButton.classList.add("btn", "btn-sm", "btn-icon", "btn-outline-secondary", "me-2");
                nextButton.classList.add("btn", "btn-sm", "btn-icon", "btn-outline-secondary", "me-4");
                headerToolbar.classList.add("row-gap-4", "gap-2");
                // Customize sidebar toggle button
                sidebarToggleButton.classList.remove("fc-button-primary");
                sidebarToggleButton.classList.add("d-lg-none", "d-inline-block", "ps-0");
                while (sidebarToggleButton.firstChild) {
                    sidebarToggleButton.firstChild.remove();
                }
                sidebarToggleButton.setAttribute("data-bs-toggle", "sidebar");
                sidebarToggleButton.setAttribute("data-overlay", "");
                sidebarToggleButton.setAttribute("data-target", "#app-calendar-sidebar");
                sidebarToggleButton.insertAdjacentHTML("beforeend", '<i class="ri-menu-line ri-24px text-body"></i>');
            }

            // Function to get selected filters
            function getSelectedFilters() {
                let selectedFilters = [];
                // Loop through checked filter inputs and push their values to the selectedFilters array
                [].slice.call(document.querySelectorAll(".input-filter:checked")).forEach(filter => {
                    selectedFilters.push(filter.getAttribute("data-value"));
                });
                return selectedFilters;
            }

            // Function to filter events based on selected filters
            function filterEvents(fetchInfo, successCallback) {
                let selectedFilters = getSelectedFilters();
                // Filter events based on selected filters
                let filteredEvents = eventList.filter(function(event) {
                    return selectedFilters.includes(event.extendedProps.calendar.toLowerCase());
                });
                // Callback with filtered events
                successCallback(filteredEvents);
            }

            // Create a new calendar instance
            let calendar = new Calendar(calendarElement, {
                // Set initial view to dayGridMonth
                initialView: "dayGridMonth",
                // Use the filterEvents function to fetch events
                events: filterEvents,
                // Plugins for additional functionalities
                plugins: [dayGridPlugin, interactionPlugin, listPlugin, timegridPlugin],
                // Enable editing
                editable: true,
                // Enable drag scrolling
                dragScroll: true,
                // Limit the number of displayed events per day
                dayMaxEvents: 2,
                // Allow resizing events from their start
                eventResizableFromStart: true,
                // Custom buttons for the header
                customButtons: {
                    sidebarToggle: {
                        text: "Sidebar"
                    }
                },
                // Define header toolbar layout
                headerToolbar: {
                    start: "sidebarToggle, prev,next, title",
                    end: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
                },
                // Set calendar direction
                direction: textDirection,
                // Set initial date to current date
                initialDate: new Date,
                // Enable navigation links
                navLinks: true,
                // Customize event class names based on event type
                eventClassNames: function({ event }) {
                    return ["fc-event-" + eventLabels[event._def.extendedProps.calendar]];
                },
                // Handle date click event
                dateClick: function(dateInfo) {
                    // Format date
                    let formattedDate = moment(dateInfo.date).format("YYYY-MM-DD");
                    // Clear form and show offcanvas
                    clearForm(), offcanvasInstance.show();
                    // Update sidebar title
                    if (sidebarTitle) {
                        sidebarTitle.innerHTML = "Add Event";
                    }
                    // Update submit button label and class
                    submitButton.innerHTML = "Add";
                    submitButton.classList.remove("btn-update-event");
                    submitButton.classList.add("btn-add-event");
                    // Hide delete event button
                    deleteEventButton.classList.add("d-none");
                    // Set start and end date inputs
                    eventStartDateInput.value = formattedDate;
                    eventEndDateInput.value = formattedDate;
                },
                // Handle event click event
                eventClick: function(eventInfo) {
                    handleEventClick(eventInfo);
                },
                // Callback when the calendar's dates have been set
                datesSet: function() {
                    customizeCalendarButtons();
                },
                // Callback when the calendar view has been mounted
                viewDidMount: function() {
                    customizeCalendarButtons();
                }
            });

            // Render the calendar
            calendar.render();

            // Customize calendar buttons
            customizeCalendarButtons();

            // Initialize form validation for event form
            const eventForm = document.getElementById("eventForm");
            FormValidation.formValidation(eventForm, {
                fields: {
                    eventTitle: {
                        validators: {
                            notEmpty: {
                                message: "Please enter event title"
                            }
                        }
                    },
                    eventStartDate: {
                        validators: {
                            notEmpty: {
                                message: "Please enter start date"
                            }
                        }
                    },
                    eventEndDate: {
                        validators: {
                            notEmpty: {
                                message: "Please enter end date"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: "",
                        rowSelector: function(field, ele) {
                            return ".mb-5";
                        }
                    }),
                    submitButton: new FormValidation.plugins.SubmitButton,
                    autoFocus: new FormValidation.plugins.AutoFocus
                }
            }).on("core.form.valid", function() {
                formValid = true;
            }).on("core.form.invalid", function() {
                formValid = false;
            });

            // Add event listener for toggle sidebar button
            toggleSidebarButton && toggleSidebarButton.addEventListener("click", e => {
                cancelButton.classList.remove("d-none");
            });


            // Function to add a new event
            function addEvent(newEvent) {
                // Push new event to the event list
                eventList.push(newEvent);
                // Refetch events in the calendar
                calendar.refetchEvents();
            }

            // Function to update an existing event
            function updateEvent(updatedEvent) {
                // Parse event ID to integer
                updatedEvent.id = parseInt(updatedEvent.id);
                // Find the index of the updated event and replace it in the event list
                eventList[eventList.findIndex(event => event.id === updatedEvent.id)] = updatedEvent;
                // Refetch events in the calendar
                calendar.refetchEvents();
            }

            // Function to delete an event
            function deleteEvent(eventId) {
                // Filter out the event with the specified ID from the event list
                eventList = eventList.filter(function(event) {
                    return event.id != eventId;
                });
                // Refetch events in the calendar
                calendar.refetchEvents();
            }

            // Event listener for submit button click
            submitButton.addEventListener("click", e => {
                // If the submit button is for adding a new event
                if (submitButton.classList.contains("btn-add-event")) {
                    // Check if the form is valid
                    if (formValid) {
                        // Create a new event object
                        let newEvent = {
                            id: calendar.getEvents().length + 1,
                            title: eventTitleInput.value,
                            start: eventStartDateInput.value,
                            end: eventEndDateInput.value,
                            startStr: eventStartDateInput.value,
                            endStr: eventEndDateInput.value,
                            display: "block",
                            extendedProps: {
                                location: eventLocationInput.value,
                                guests: eventGuestsSelect.val(),
                                calendar: eventLabelSelect.val(),
                                description: eventDescriptionInput.value
                            }
                        };
                        // Add event URL if provided
                        if (eventURLInput.value) {
                            newEvent.url = eventURLInput.value;
                        }
                        // Set allDay property if the event is an all-day event
                        if (allDaySwitch.checked) {
                            newEvent.allDay = true;
                        }
                        // Add the new event
                        addEvent(newEvent);
                        // Hide the offcanvas
                        offcanvasInstance.hide();
                    }
                } else if (formValid) {
                    // If the submit button is for updating an existing event
                    // Create an updated event object
                    let updatedEvent = {
                        id: currentEvent.id,
                        title: eventTitleInput.value,
                        start: eventStartDateInput.value,
                        end: eventEndDateInput.value,
                        url: eventURLInput.value,
                        extendedProps: {
                            location: eventLocationInput.value,
                            guests: eventGuestsSelect.val(),
                            calendar: eventLabelSelect.val(),
                            description: eventDescriptionInput.value
                        },
                        display: "block",
                        allDay: !!allDaySwitch.checked
                    };
                    // Update the event
                    updateEvent(updatedEvent);
                    // Hide the offcanvas
                    offcanvasInstance.hide();
                }
            });

            // Event listener for delete event button click
            deleteEventButton.addEventListener("click", e => {
                // Delete the current event
                deleteEvent(parseInt(currentEvent.id));
                // Hide the offcanvas
                offcanvasInstance.hide();
            });

            // Function to clear the event form
            function clearForm() {
                eventEndDateInput.value = "";
                eventURLInput.value = "";
                eventStartDateInput.value = "";
                eventTitleInput.value = "";
                eventLocationInput.value = "";
                allDaySwitch.checked = false;
                eventGuestsSelect.val("").trigger("change");
                eventDescriptionInput.value = "";
            }


           // Event listener for when the add event sidebar is hidden
            addEventSidebar.addEventListener("hidden.bs.offcanvas", function() {
                // Clear the form when the sidebar is hidden
                clearForm();
            });

            // Event listener for toggle sidebar button click
            toggleSidebarButton.addEventListener("click", e => {
                // Set the sidebar title and button text for adding a new event
                if (sidebarTitle) {
                    sidebarTitle.innerHTML = "Add Event";
                }
                submitButton.innerHTML = "Add";
                submitButton.classList.remove("btn-update-event");
                submitButton.classList.add("btn-add-event");
                deleteEventButton.classList.add("d-none");
                // Hide the sidebar and overlay
                calendarSidebar.classList.remove("show");
                overlayElement.classList.remove("show");
            });

            // Event listener for select all filters checkbox click
            selectAllFiltersCheckbox && selectAllFiltersCheckbox.addEventListener("click", e => {
                // If select all filters checkbox is checked, check all filter inputs; otherwise, uncheck all
                if (e.currentTarget.checked) {
                    document.querySelectorAll(".input-filter").forEach(filter => filter.checked = true);
                } else {
                    document.querySelectorAll(".input-filter").forEach(filter => filter.checked = false);
                }
                // Refetch events in the calendar
                calendar.refetchEvents();
            });

            // Event listener for filter inputs click
            filterInputs && filterInputs.forEach(filterInput => {
                filterInput.addEventListener("click", () => {
                    // Check if all filter inputs are checked, update select all filters checkbox accordingly
                    if (document.querySelectorAll(".input-filter:checked").length < document.querySelectorAll(".input-filter").length) {
                        selectAllFiltersCheckbox.checked = false;
                    } else {
                        selectAllFiltersCheckbox.checked = true;
                    }
                    // Refetch events in the calendar
                    calendar.refetchEvents();
                });
            });

            // Event listener for inline calendar instance change
            inlineCalendarInstance.config.onChange.push(function(selectedDates) {
                // Change the view of the calendar to the selected date in the inline calendar
                calendar.changeView(calendar.view.type, moment(selectedDates[0]).format("YYYY-MM-DD"));
                // Customize calendar buttons
                customizeCalendarButtons();
                // Hide the sidebar and overlay
                calendarSidebar.classList.remove("show");
                overlayElement.classList.remove("show");
            });

        })()
    });
</script>

<script>
    let currentDate = new Date,
    tomorrowDate = new Date(new Date().getTime() + 24 * 60 * 60 * 1000),
    nextMonthStart = currentDate.getMonth() === 11 ? new Date(currentDate.getFullYear() + 1, 0, 1) : new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 1),
    lastMonthStart = currentDate.getMonth() === 11 ? new Date(currentDate.getFullYear() - 1, 0, 1) : new Date(currentDate.getFullYear(), currentDate.getMonth() - 1, 1);
    window.events = [{
        id: 1,
        url: "",
        title: "Design Review",
        start: currentDate,
        end: tomorrowDate,
        allDay: false,
        extendedProps: {
            calendar: "Business"
        }
    }, {
        id: 2,
        url: "",
        title: "Meeting With Client",
        start: new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, -11),
        end: new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, -10),
        allDay: true,
        extendedProps: {
            calendar: "Business"
        }
    }, {
        id: 3,
        url: "",
        title: "Family Trip",
        allDay: true,
        start: new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, -9),
        end: new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, -7),
        extendedProps: {
            calendar: "Holiday"
        }
    }, {
        id: 4,
        url: "",
        title: "Doctor's Appointment",
        start: new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, -11),
        end: new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, -10),
        extendedProps: {
            calendar: "Personal"
        }
    }, {
        id: 5,
        url: "",
        title: "Dart Game?",
        start: new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, -13),
        end: new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, -12),
        allDay: true,
        extendedProps: {
            calendar: "ETC"
        }
    }, {
        id: 6,
        url: "",
        title: "Meditation",
        start: new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, -13),
        end: new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, -12),
        allDay: true,
        extendedProps: {
            calendar: "Personal"
        }
    }, {
        id: 7,
        url: "",
        title: "Dinner",
        start: new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, -13),
        end: new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, -12),
        extendedProps: {
            calendar: "Family"
        }
    }, {
        id: 8,
        url: "",
        title: "Product Review",
        start: new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, -13),
        end: new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, -12),
        allDay: true,
        extendedProps: {
            calendar: "Business"
        }
    }, {
        id: 9,
        url: "",
        title: "Monthly Meeting",
        start: nextMonthStart,
        end: nextMonthStart,
        allDay: true,
        extendedProps: {
            calendar: "Business"
        }
    }, {
        id: 10,
        url: "",
        title: "Monthly Checkup",
        start: lastMonthStart,
        end: lastMonthStart,
        allDay: true,
        extendedProps: {
            calendar: "Personal"
        }
    }];
</script>

@endpush