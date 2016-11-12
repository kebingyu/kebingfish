$(document).ready(function () {
    $('#expires_at').pickadate({
        format: 'mm/dd/yyyy'
    });

    $('form.update-event').submit(function (e) {
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
                resetModal();
            }
        }).done(function (data) {
            if (data['ok']) {
                var url = self.find('.success-url').data('url');
                // Popup message
                showModal('Event updated.');
                window.location = url;
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
