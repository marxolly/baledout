// JavaScript Document
(function (Calendar) {
    var cal;
    // Constants
    var CALENDAR_CSS_PREFIX = 'toastui-calendar-';
    var cls = function (className) {
        return CALENDAR_CSS_PREFIX + className;
    };

    // Elements
    var navbarRange = $('.navbar--range');
    var prevButton = $('#prev');
    var nextButton = $('#next');
    var todayButton = $('#today');
    var dropdown = $('#calendar_view');

    // App State
    var appState = {

    };

    // functions to handle calendar behaviors
    function reloadEvents() {

    }

    function getReadableViewName(viewType) {
        switch (viewType) {
            case 'month':
                return 'Monthly';
            case 'week':
                return 'Weekly';
            case 'day':
                return 'Daily';
            default:
                throw new Error('no view type');
        }
    }

    function displayRenderRange() {
        var rangeStart = cal.getDateRangeStart();
        var rangeEnd = cal.getDateRangeEnd();

        navbarRange.textContent = getNavbarRange(rangeStart, rangeEnd, cal.getViewName());
    }

    function getNavbarRange(tzStart, tzEnd, viewType) {
        var start = tzStart.toDate();
        var end = tzEnd.toDate();
        var middle;
        if (viewType === 'month') {
            middle = new Date(start.getTime() + (end.getTime() - start.getTime()) / 2);

            return moment(middle).format('YYYY-MM');
        }
        if (viewType === 'day') {
            return moment(start).format('YYYY-MM-DD');
        }
        if (viewType === 'week') {
            return moment(start).format('YYYY-MM-DD') + ' ~ ' + moment(end).format('YYYY-MM-DD');
        }
        throw new Error('no view type');
    }

    function setSelectViewValue()
    {
        var viewName = cal.getViewName();
        $("#calendar_view").val(viewName).change();
    }

    function update() {
        //setDropdownTriggerText();
        //setSelectViewValue();
        displayRenderRange();
        reloadEvents();
    }

    function bindAppEvents() {
        //dropdownTrigger.addEventListener('click', toggleDropdownState);

        prevButton.on('click', function () {
            cal.prev();
            update();
        });

        nextButton.on('click', function () {
            cal.next();
            update();
        });

        todayButton.on('click', function () {
            cal.today();
            update();
        });

        $('select#calendar_view').change(function(e){
            console.log('calling change');
            var targetViewName = $(e.target).val();
            //console.log(targetViewName);
            cal.changeView(targetViewName);
            update();
        });

    }

    function bindInstanceEvents() {
        cal.on({
            clickMoreEventsBtn: function (btnInfo) {
                console.log('clickMoreEventsBtn', btnInfo);
            },
            clickEvent: function (eventInfo) {
                console.log('clickEvent', eventInfo);
            },
            clickDayName: function (dayNameInfo) {
                console.log('clickDayName', dayNameInfo);
            },
            selectDateTime: function (dateTimeInfo) {
                console.log('selectDateTime', dateTimeInfo);
            },
            beforeCreateEvent: function (event) {
                console.log('beforeCreateEvent', event);
                event.id = chance.guid();

                cal.createEvents([event]);
                cal.clearGridSelections();
            },
            beforeUpdateEvent: function (eventInfo) {
                var event, changes;

                console.log('beforeUpdateEvent', eventInfo);

                event = eventInfo.event;
                changes = eventInfo.changes;

                cal.updateEvent(event.id, event.calendarId, changes);
            },
            beforeDeleteEvent: function (eventInfo) {
                console.log('beforeDeleteEvent', eventInfo);

                cal.deleteEvent(eventInfo.id, eventInfo.calendarId);
            },
        });
    }


    function getEventTemplate(event, isAllday) {
        var html = [];
        var start = moment(event.start.toDate().toUTCString());
        if (!isAllday) {
            html.push('<strong>' + start.format('HH:mm') + '</strong> ');
        }

        if (event.isPrivate) {
            html.push('<span class="calendar-font-icon ic-lock-b"></span>');
            html.push(' Private');
        } else {
            if (event.recurrenceRule) {
                html.push('<span class="calendar-font-icon ic-repeat-b"></span>');
            } else if (event.attendees.length > 0) {
                html.push('<span class="calendar-font-icon ic-user-b"></span>');
            } else if (event.location) {
                html.push('<span class="calendar-font-icon ic-location-b"></span>');
            }
            html.push(' ' + event.title);
        }

        return html.join('');
    }

    // Calendar instance with options
    cal = new Calendar('#calendar', {
        calendars: [
            {
                id: 'all_drivers',
                name: 'All Drivers',
                backgroundColor: '#03bd9e',
            }
        ],
        week: {
            workweek: true,
            hourStart: 3,
            hourEnd: 18,
            eventView: ['time'],
            taskView: false
        },
        timezone: {
            zones: [
                {
                    timezoneName: 'Australia/Adelaide',
                    displayLabel: 'Adelaide',
                }
            ],
        },
        usageStatistics: false,
        useFormPopup: true,
        useDetailPopup: true,
        eventFilter: function (event) {
            var currentView = cal.getViewName();
            if (currentView === 'month') {
                return ['allday', 'time'].includes(event.category) && event.isVisible;
            }

            return event.isVisible;
        },
        template: {
            allday: function (event) {
                return getEventTemplate(event, true);
            },
            time: function (event) {
                return getEventTemplate(event, false);
            },
        },
    });

    // Init
    bindInstanceEvents();
    bindAppEvents();
    //initCheckbox();
    update();
})(tui.Calendar);