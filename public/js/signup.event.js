$(document).ready(function () {
    $('.table-striped').on('click', '.user-name', function (e) {
        e.preventDefault();
        var self = $(this);
        if (!confirm('Remove ' + self.find('a').text() + ' from this event?')) {
            return;
        }
        $.ajax({
            url: self.find('a').attr('href'),
            method: "DELETE"
        }).done(function (data) {
            if (data['ok']) {
                return self.parent().fadeOut(300, function() {
                    $(this).remove();
                });
            }
            alert(data['error']);
        });
    });

    $('form.signup').submit(function (e) {
        e.preventDefault();
        var self = $(this);
        var url = self.attr('action');
        $.ajax({
            method: self.attr('method'),
            url: url,
            data: self.serialize()
        }).done(function (data) {
            if (data['ok']) {
                var elem = $('.table-striped tr:last');
                if (elem.length == 0) {
                    return window.location.reload(true);
                }
                var html = '<tr>'
                    + '<td class="user-name">'
                    + '<a href="' + url + '/' + data['data']['name'] + '">' + data['data']['name'] + '</a>'
                    + '</td>'
                    + '</tr>';
                return elem.after(html);
            }
            alert(data['error']);
        });
    });
});
