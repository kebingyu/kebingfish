$(document).ready(function () {
    $('#expires_at').datepicker({
        todayHighlight: true
    });

    $('form.create-event').submit(function (e) {
        e.preventDefault();
        var self = $(this);
        var url = self.attr('action');
        $.ajax({
            method: self.attr('method'),
            url: url,
            data: self.serialize()
        }).done(function (data) {
            if (data['ok']) {
                var elem = $('.table-bordered tr:last');
                data = data['data'];
                url = 'http://' + window.location.hostname + '/signup/events/';
                var html = '<tr>'
                    + '<td class=""><a href="' + url + data['id'] + '">' + data['title'] + '</a></td>'
                    + '<td class="">' + data['description'] + '</td>'
                    + '<td>0</td>'
                    + '<td>' + data['expires_in'] + '</td>'
                    + '</tr>';
                return elem.after(html);
            }
            alert(data['error']);
        });
    });
});
