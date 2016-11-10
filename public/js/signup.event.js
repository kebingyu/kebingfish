$(document).ready(function () {
    $('.table-striped').on('click', '.user-name', function (e) {
        e.preventDefault();
        var self = $(this);
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
                var count = parseInt(elem.find('td.user-count').html()) + 1;
                var html = '<tr>'
                    + '<td class="user-count">' + count + '</td>'
                    + '<td class="user-name"><a href="' + url + '/' + data['data']['name'] + '">' + data['data']['name'] + '</a></td>'
                    + '</tr>';
                return elem.after(html);
            }
            alert(data['error']);
        });
    });
});
