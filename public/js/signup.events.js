$(document).ready(function () {
    $('#expires_at').pickadate({
        format: 'mm/dd/yyyy'
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
                var elem = $('.event-list li:last');
                if (elem.length == 0) {
                    return window.location.reload(true);
                }
                data = data['data'];
                url = 'http://' + window.location.hostname + '/signup/events/';
                var html = '<li class="list-group-item">'
                    + '<a href="' + url + data['id'] + '">' + data['title']
                    + '<span class="badge goer-count">0</span>'
                    + '<span class="glyphicon glyphicon-chevron-right pull-right"></span>'
                    + '</a>'
                    + '</li>';
                return elem.after(html);
            }
            alert(data['error']);
        });
    });
});
