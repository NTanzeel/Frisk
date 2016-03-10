$(document).ready(function() {
    var messages = $('.messages');

    messages.on('click', '.message', function() {
        var target = $(event.target);
        if (!target.hasClass('no-redirect') && target.parent('.no-redirect').length == 0) {
            window.location.href = $(this).attr('href');
        }
    });
});