$(document).ready(function() {

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        defaultDate: '2017-11-12',
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: [
            {
                title: 'All Day Event',
                start: '2017-11-01',
                className: "d-fc-event-danger"
            },
            {
                title: 'Long Event',
                start: '2017-11-07',
                end: '2017-11-10'
            },
            //{
            //    id: 999,
            //    title: 'Repeating Event',
            //    start: '2017-11-09T16:00:00'
            //},
            //{
            //    id: 999,
            //    title: 'Repeating Event',
            //    start: '2017-11-16T16:00:00'
            //},
            {
                title: 'Conference',
                start: '2017-11-17',
                end: '2017-11-13',
                className: "d-fc-event-warning"
            },
            {
                title: 'Meeting',
                start: '2017-11-12T10:30:00',
                end: '2017-11-12T12:30:00'
            },
            {
                title: 'Lunch',
                start: '2017-11-12T12:00:00'
            },
            {
                title: 'Meeting',
                start: '2017-11-12T14:30:00'
            },
            {
                title: 'Happy Hour',
                start: '2017-11-12T17:30:00'
            },
            {
                title: 'Dinner',
                start: '2017-11-12T20:00:00'
            },
            {
                title: 'Birthday Party',
                start: '2017-11-13T07:00:00',
                className: "d-fc-event-info"
            },
            {
                title: 'Click for Google',
                url: 'http://google.com/',
                start: '2017-11-28',
                className: "d-fc-event-success"
            }
        ]
    });

});