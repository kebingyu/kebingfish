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
            data: self.serialize(),
            beforeSend: function () {
                var div = self.find('.has-error');
                div.find('.error-block').html('');
                div.removeClass('has-error');
            }
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
        }).fail(function (data) {
            var error = data.responseJSON;
            for (var key in error) {
                var div = $('input[name="' + key + '"]').parents('.form-group');
                var ul = div.find('.error-block');
                for (var i = 0, j = error[key].length; i < j; i++) {
                    var html = '<li>' + error[key][i] + '</li>';
                    ul.append(html);
                }
                div.addClass('has-error');
            }
        });
    });
});
