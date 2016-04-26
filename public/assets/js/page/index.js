$(document).ready(function() {
    var element = $('#crimes_near_by').get(0);
    var map = Maps.create('nearby_crimes', element);

    Maps.getLocation(processLocation, handleLocationError);

    function processLocation(location) {
        /**
         * Generate the crime map on the homepage.
         */
        generateCrimeMap(true, location);

        /**
         * Append coordinates fields to the search form.
         */
        $('.search-form')
            .append('<input type="hidden" name="latitude" value="' + location.lat + '" />')
            .append('<input type="hidden" name="longitude" value="' + location.lng + '" />');
    }

    function handleLocationError(message) {
        generateCrimeMap(false, {});
    }

    function generateCrimeMap(bool, location) {
        if (bool) {
            map.setCenter(location);
            $(element).data('latitude', location.lat).data('longitude', location.lng);
        }
        getCrimes(map, element);
    }

    function getCrimes(map, element) {
        var url = 'https://data.police.uk/api/crimes-street/all-crime';
        $.getJSON(url, {lat: $(element).data('latitude'), lng:  $(element).data('longitude')}, function(data) {
            $.each(data, function(key, crime) {
                if (crime.category.indexOf('theft') > -1
                    || crime.category.indexOf('burglary')  > -1
                    || crime.category.indexOf('robbery')  > -1) {
                    Maps.addMarker(map, {lat: parseFloat(crime.location.latitude), lng: parseFloat(crime.location.longitude)});
                }
            });
        });
    }
});