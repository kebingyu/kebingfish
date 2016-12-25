$(function () {
    // Merge tool: show selected file names
    $('.filesToUpload').on('change', function (e) {
        var ul = $('#js-merge-files-ul');
        ul.html('');
        var files = $(this)[0].files;
        if (files.length > 0) {
            for (var i = 0, j = files.length; i < j; i++) {
                var html = '<li class="js-merge-files-li list-group-item">'
                    + files[i].name
                    + '</li>';
                ul.append(html);
            }

            $('#js-merge-files').fadeIn('slow', function () {
                var submit = $('#js-vbase2-submit');
                if (submit.length > 0) {
                    submit.removeClass('hidden').fadeIn('slow');
                }
            });

            $('#js-vbase2-submit').find('.activeUpload').val($(this).data('name'));
        }
    }).on('click', function (e) {
        $(this).val('');
        var submit = $('#js-vbase2-submit');
        if (submit.is(':visible')) {
            submit.fadeOut('slow', function () {
                $('#js-merge-files').fadeOut('slow');
            });
        } else {
            $('#js-merge-files').fadeOut('slow');
        }
    });
});
