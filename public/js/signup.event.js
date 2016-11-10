$(document).ready(function () {
    // Remove user from signup list
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
                // Update goer count
                $('.badge').text(data['data']['goer_count']);
                // Remove table row
                return self.parent().fadeOut(300, function() {
                    $(this).remove();
                });
            }
            alert(data['error']);
        });
    });

    // Add user from signup list
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
                // Update goer count
                $('.badge').text(data['data']['goer_count']);
                // Append table row
                var name = self.find('input[name="name"]').val();
                var size = self.find('input[name="group_size"]').val() || 1;
                var html = '<tr>'
                    + '<td class="user-name">'
                    + '<a href="' + url + '/' + name + '">' + name + '</a>'
                    + '</td>'
                    + '<td class="user-group-size">' + size + '</td>'
                    + '</tr>';
                return elem.after(html);
            }
            alert(data['error']);
        });
    });
});
