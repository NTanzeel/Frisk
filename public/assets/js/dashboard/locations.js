$(document).ready(function() {

    $('.locations .location .map').each(function(key, element) {
        addMap(element);
    });

    $('#newLocationForm').AddressLookup({
        ajaxSubmit : true,
        onSubmit : function(address) {
            var maps = $('<div class="col-sm-6 col-md-4">' +
                '<div id="location-' + address.id + '" class="location">' +
                '<button type="button" class="delete" data-for="#location-' + address.id + '" data-target="' + Frisk.get('deletePath').replace('id', address.id ) + '" data-token="' + Frisk.get('deleteToken') +'">' +
                '<i class="fa fa-trash-o"></i>' +
                '</button>' +
                '<div class="map" data-latitude="' + address.latitude + '" data-longitude="' + address.longitude + '"></div>' +
                '<div class="address-label">' + address.first_address_line + ', ' + address.postcode + '</div>' +
                '</div>' +
                '</div>').appendTo('.locations').find('.map');

            addMap(maps[0]);
        }
    });

    function addMap(element) {
        var map = new google.maps.Map(element, {
            center: {lat: $(element).data('latitude'), lng: $(element).data('longitude')},
            zoom: 14,
            disableDefaultUI: true,
            draggable: false,
            scrollwheel: false,
            disableDoubleClickZoom: true,
            styles: [
                {
                    featureType: "all",
                    elementType: "labels",
                    stylers: [
                        { visibility: "off" }
                    ]
                }
            ]
        });

        var marker = new google.maps.Marker({
            position: {lat: $(element).data('latitude'), lng: $(element).data('longitude')},
            map: map,
            icon: 'https://cdn2.iconfinder.com/data/icons/bitsies/128/Location-24.png'
        });
    }
});