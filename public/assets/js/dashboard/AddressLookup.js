(function ($) {

    $.fn.AddressLookup = function (options) {

        var form = $(this);

        initialize();

        function initialize() {
            this.newSearch = true;

            this.geoCoder = new google.maps.Geocoder();

            this.options = $.extend({
                ajaxSubmit: false,
                lookupSection: form.find('#addressLookup'),
                addressSection: form.find('#addressFields'),
                lookupPostcode: form.find('#search_postcode'),
                onFill: function (fields, address) {
                },
                onSubmit: function (address) {
                }
            }, options);

            bindElements();
        }

        function bindElements() {
            var that = this;

            $(this).on('submit', function (event) {
                if (that.newSearch || that.options.ajaxSubmit) {
                    event.preventDefault();
                }

                if (that.newSearch) {
                    that.newSearch = false;
                    getAddress(that.options.lookupPostcode.val(), processResult);
                } else if (that.options.ajaxSubmit) {
                    saveLocation(this);
                }
            });

            $(this).on('reset', function () {
                that.newSearch = true;
                that.options.lookupSection.toggleClass('hidden');
                that.options.addressSection.toggleClass('hidden');
            });
        }

        function getAddress(postcode, callback) {
            this.geoCoder.geocode({'address': postcode}, function (results, status) {
                callback({'status': status, 'address': sortResults(postcode, results)});
            });
        }

        function sortResults(postcode, results) {
            var address = {'postal_code': postcode};
            if (results.length > 0) {
                for (var i = 0; i < results[0]['address_components'].length; i++) {
                    address[results[0]['address_components'][i]['types'][0]] = results[0]['address_components'][i]['long_name'];
                }

                address.coordinates = {
                    'latitude': results[0].geometry.location.lat(),
                    "longitude": results[0].geometry.location.lng()
                };
            }

            return address;
        }

        function processResult(result) {
            if (result.status = google.maps.GeocoderStatus.OK) {
                fillForm(result.address);
                this.options.lookupSection.toggleClass('hidden');
                this.options.addressSection.toggleClass('hidden');
            } else {
                this.newSearch = true;
            }
        }

        function fillForm(address) {
            appendCoordinates(address.coordinates);
            this.options.addressSection.find('#first_address_line').val(address.route);
            this.options.addressSection.find('#city').val(address.postal_town);
            this.options.addressSection.find('#region').val(address.administrative_area_level_2);
            this.options.addressSection.find('#postcode').val(address.postal_code);
            this.options.onFill(this.options.addressSection, address);
        }

        function appendCoordinates(coordinates) {
            var that = this;
            $.each(coordinates, function (key, value) {
                var component = that.options.addressSection.find('#' + key);
                if (!component.length) {
                    component = $('<input type="hidden" name="' + key + '" id="' + key + '">').prependTo(that.options.addressSection);
                }
                component.val(value);
            });
        }

        function saveLocation(that) {
            $.post(form.attr('action'), form.serialize(), function(data) {
                form.trigger('reset');
                $('#createLocationModal').modal('hide');
                that.options.onSubmit($.parseJSON(data));
            });
        }
    };
}(jQuery));