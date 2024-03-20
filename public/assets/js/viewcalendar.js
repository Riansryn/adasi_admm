$(document).ready(function() {
    $('#calendar').fullCalendar({
        locale: 'id',
        defaultView: 'month',
        events: scheduleVisits.map(function(visit) {
            return {
                title: 'Melakukan Schedule Visit - ' + visit.pic,
                start: visit.schedule,
                end: visit.due_date,
                description: visit.description // tambahkan deskripsi jika diperlukan
            };
        }),
        eventClick: function(calEvent, jsEvent, view) {
            $('#eventModal #eventDetails').html(
                '<p><strong>' + calEvent.title + '</strong></p>' +
                '<p><strong>Tanggal:</strong> ' + calEvent.start.format('YYYY-MM-DD') + '</p>' +
                '<p><strong>Deskripsi:</strong> ' + (calEvent.description ? calEvent.description : 'Tidak ada deskripsi') + '</p>'
            );
            $('#eventModal').modal('show');
        }
    });
});
