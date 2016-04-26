$(document).ready(function() {
    var messages = $('.messages');

    messages.on('click', '.message', function() {
        var target = $(event.target);
        if (!target.hasClass('no-redirect') && target.parent('.no-redirect').length == 0) {
            window.location.href = $(this).attr('href');
        }
    });

    $('#delete-selected').on('click', function(event) {
        event.preventDefault();
        $.each($('.select-message:checked'), function(id, checkbox) {
            console.log($(checkbox).parents('.message'));
            $(checkbox).parents('.message').find('.delete').trigger('click');
        });
    });
});