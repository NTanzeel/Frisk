$(document).ready(function() {

    var searchForm = $('#search_address_form');
    var createForm = $('#create_location_form');

    var geoCoder = new google.maps.Geocoder();

    searchForm.on('submit', function(event) {
        event.preventDefault();

        getAddress($('#search_postcode').val(), function(result) {
            if (result.status = google.maps.GeocoderStatus.OK) {
                fillAddress(result.address);
                searchForm.toggleClass('hidden');
                createForm.toggleClass('hidden');
            } else {
                console.log('error: ' + result.status);
            }
        });
    });

    createForm.on('reset', function() {
        searchForm.toggleClass('hidden');
        createForm.toggleClass('hidden');
    });


    function getAddress(postcode, callback) {
        geoCoder.geocode({'address': postcode}, function (results, status) {
            var address = {'postal_code' : postcode};
            if (results.length > 0) {
                for (var i = 0; i < results[0]['address_components'].length; i++) {
                    address[results[0]['address_components'][i]['types'][0]] = results[0]['address_components'][i]['long_name'];
                }
            }
            callback({'status' : status, 'address' : address});
        });
    }

    function fillAddress(address) {
        $('#first_address_line').val(address.route);
        $('#city').val(address.postal_town);
        $('#region').val(address.administrative_area_level_2);
        $('#postcode').val(address.postal_code);
    }
});