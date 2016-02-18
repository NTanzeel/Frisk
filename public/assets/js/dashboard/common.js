$(document).ready(function() {

    $('body').on('click', '.delete', function(event) {
        event.stopPropagation();
        var that = this;
        $.ajax({
            url : $(that).data('target'),
            type: 'post',
            data: {_method: 'DELETE', _token : $(that).data('token')},

            success : function(response) {
                showNotification('success', response.message);
                $($(that).data('for')).parent().fadeOut('slow', function() {
                    $(this).remove();
                });
            },

            error : function(response) {
                showNotification('danger', response.responseJSON.message);
            }
        });
    });

    function showNotification(type, message) {
        $('#notification-slider').removeClass(function (index, css) {
            return css != 'alert-dismissible' && (css.match (/(^|\s)alert-\S+/g) || []).join(' ');
        }).addClass('alert-' + type).text(message).animate({top : '-20px'}, 200);

        setTimeout(function() {
            $('#notification-slider').text('').animate({top : '-52px'}, 200);
        }, 3000)
    }
});