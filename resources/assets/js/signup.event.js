$(document).ready(function () {
    // Remove user from signup list
    $('.table-striped').on('click', '.user-name', function (e) {
        e.preventDefault();
        var self = $(this);
        var name = self.find('a').text();
        if (!confirm('Remove ' + name + ' from this event?')) {
            return;
        }
        $.ajax({
            url: self.find('a').attr('href'),
            method: "DELETE",
            beforeSend: function () {
                resetModal();
            }
        }).done(function (data) {
            if (data['ok']) {
                // Update goer count
                $('.badge').text(data['data']['goer_count']);
                // Remove table row
                self.parent().fadeOut(300, function() {
                    $(this).remove();
                });
                // Popup message
                showModal(name + '\'s group has been removed.');
                return;
            }
            // Popup message
            showModal(data['error'], 'danger');
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
            data: self.serialize(),
            beforeSend: function () {
                // Clear validation error
                var div = self.find('.has-error');
                div.find('.error-block').html('');
                div.removeClass('has-error');
                resetModal();
            }
        }).done(function (data) {
            if (data['ok']) {
                var elem = $('.table-striped tbody');
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
                elem.append(html);
                // Popup message
                showModal(name + '\'s group has been added.');
                return;
            }
            // Popup message
            showModal(data['error'], 'danger');
        }).fail(function (data) {
            var error = data.responseJSON;
            for (var key in error) {
                var div = $('input[name="' + key + '"]').parents('.form-group');
                var ul = div.find('.error-block');
                for (var i = 0, j = error[key].length; i < j; i++) {
                    var html = '<li class="text-danger">' + error[key][i] + '</li>';
                    ul.append(html);
                }
                div.addClass('has-error');
            }
        });
    });

    function resetModal() {
        $('#signup-message')
        .find('.text-success').html('')
        .end().find('.text-danger').html('');
    }

    function showModal(message, type) {
        var type = type || 'success';
        var elem = '.text-' + type;
        $('#signup-message').find(elem).html(message).end().modal();
    }
});
