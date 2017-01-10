$(function() {
    $('form').submit(function(e) {
        e.preventDefault();
        var self = $(this);

        $.ajax({
            method: self.attr('method'),
            url: self.attr('action'),
            data: self.serialize(),
            beforeSend: function () {
                $('.definitions').html('');
            }
        }).done(function (data) {
            if (data['ok']) {
                return buildDefinition(data['data']);
            }
            buildError(data['error']);
        });
    });

    function buildDefinition(data)
    {
        var div = $('.definitions');
        var html = '<ul>';
        for (var i = 0; i < data.length; i++) {
            html += '<li><p class="definition">' + data[i].definition + '</p>';
            for (var j = 0; j < data[i].examples.length; j++) {
                html += '<p class="example">' + data[i].examples[j] + '</p>';
            }
            html += '</li>';
        }
        html += '</ul>';
        div.append(html);
    }

    function buildError(message)
    {
        $('.definitions').append('<p>' + message + '</p>');
    }
});
