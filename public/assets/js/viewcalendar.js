$(document).ready(function() {
    $('#calendar').fullCalendar({
        locale: 'id',
        defaultView: 'month',
        events: scheduleVisits.map(function(visit) {
            return {
                title: 'Melakukan Schedule Visit - ' + visit.pic,
                start: visit.schedule,
                end: visit.due_date
            };
        })
    });
});