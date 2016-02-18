$(document).ready(function() {

    $('.location .map').each(function(key, element) {
        addMap(element);
    });

    $('#newLocationForm').AddressLookup({
        ajaxSubmit : true,
        onSubmit : function(address) {
            var html = fillHTML(getContentBox(), {
                ':id' : address.id,
                ':url' : Frisk.get('deletePath').replace('id', address.id ),
                ':token' : Frisk.get('deleteToken'),
                ':latitude' : address.latitude,
                ':longitude' : address.longitude,
                ':label' : address.first_address_line + ', ' + address.postcode
            });

            var map = $(html).appendTo('#saved-locations').find('.map').get(0);
            addMap(map);
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
            styles: [{
                featureType: "all",
                elementType: "labels",
                stylers: [{visibility: "off"}]
            }]
        });

        var marker = new google.maps.Marker({
            position: {lat: $(element).data('latitude'), lng: $(element).data('longitude')},
            map: map,
            icon: 'https://cdn2.iconfinder.com/data/icons/bitsies/128/Location-24.png'
        });
    }

    function fillHTML(html, replacements) {
        $.each(replacements, function(key, value) {
            html = html.replace(new RegExp(key, 'g'), value);
        });

        return html;
    }

    function getContentBox() {
        return '<div class="col-sm-6 col-md-4">' +
                '<div id="location-:id" class="content-box location">' +
                    '<ul class="list-inline action-list top-right">' +
                        '<li>' +
                            '<a class="delete" data-for="#location-:id" data-target=":url" data-token=":token">' +
                                '<i class="fa fa-trash-o"></i>' +
                            '</a>' +
                        '</li>' +
                    '</ul>' +
                    '<div class="content-body">' +
                        '<div class="map" data-latitude=":latitude" data-longitude=":longitude"></div>' +
                    '</div>' +
                    '<div class="content-label">:label</div>' +
                '</div>' +
            '</div>';
    }
});