$(document).ready(function() {
    $('.show-item').on('click', function(event) {
        event.preventDefault();
        $.getJSON($(this).attr('href'), function( data ) {

        });
    });
});