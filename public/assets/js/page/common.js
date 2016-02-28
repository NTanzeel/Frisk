$(document).ready(function() {
    $('.search-form').on('submit', function(event) {
        if ($(this).find('.search-query').val().length < 3) {
            event.preventDefault();
        }
    });

    $('.search-near-me').on('click', function(event) {
        event.preventDefault();
        var link = $(this);
        Maps.getLocation(function (location) {
            window.location.href = link.attr('href').replace(':latitude', location.lat).replace(':longitude', location.lng);
        }, function (message) {});
    });
});