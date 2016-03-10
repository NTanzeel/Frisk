var Maps = Maps || (function(){
    var _args = {};
    var _maps = {};
    return {
        init : function(args) {
            _args = args;
        },

        getLocation: function(success, error) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var location = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    success(location);
                }, function() {
                    error('Unable to determine your current location.')
                });
            } else {
                error('Your browser does not support Geo Location.');
            }
        },

        create: function(id, element) {
            return this.createRaw(id, element, {
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
        },

        createRaw: function(id, element, options) {
            return _maps[id] = new google.maps.Map(element, options);
        },

        get : function(id) {
            return _maps[key];
        },

        addMarkers: function(map, markers) {
            var that = this;
            $.each(markers, function(key, marker) {
                var options = {
                    position: marker,
                    map: map
                };

                if (_args.map_marker) {
                    options['icon'] = _args.map_marker;
                }

                new google.maps.Marker(options);
            })
        },

        addMarker: function(map, marker) {
            var options = {
                position: marker,
                map: map
            };

            if (_args.map_marker) {
                options['icon'] = _args.map_marker;
            }

            new google.maps.Marker(options);
        }
    };
}());