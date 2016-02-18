(function ($) {

    $.fn.AddressLookup = function (options) {

        var $form = $(this);
        var $modal = $('#createLocationModal');

        initialize();

        function initialize() {
            this.newSearch = true;

            this.geoCoder = new google.maps.Geocoder();

            this.options = $.extend({
                ajaxSubmit: false,
                lookupSection: $form.find('#addressLookup'),
                addressSection: $form.find('#addressFields'),
                lookupPostcode: $form.find('#search_postcode'),
                onFill: function (fields, address) {
                },
                onSubmit: function (address) {
                }
            }, options);

            bindElements();
        }

        function bindElements() {
            var that = this;

            $modal.on('hidden.bs.modal', function() {
                $form.trigger('reset');
            });

            $form.find('#use_current_location').on('click', function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var location = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        that.newSearch = false;
                        getAddress(location, handleAddress);
                    }, function() {

                    });
                } else {

                }
            });

            $(this).on('submit', function (event) {
                if (that.newSearch || that.options.ajaxSubmit) {
                    event.preventDefault();
                }

                if (that.newSearch) {
                    that.newSearch = false;
                    getLocation(that.options.lookupPostcode.val().toUpperCase(), handleAddress);
                } else if (that.options.ajaxSubmit) {
                    saveLocation(this);
                }
            });

            $(this).on('reset', function () {
                that.newSearch = true;
                that.options.lookupSection.removeClass('hidden');
                that.options.addressSection.addClass('hidden');

                that.options.lookupSection.find('.has-error').removeClass('has-error').find('.help-block').remove();
                that.options.addressSection.find('.has-error').removeClass('has-error').find('.help-block').remove();
            });
        }

        function getAddress(location, callback) {
            this.geoCoder.geocode({'location': location}, function (results, status) {
                handleResponse({'status': status, 'result': results}, callback);
            });
        }

        function getLocation(postcode, callback) {
            this.geoCoder.geocode({'address': postcode}, function (results, status) {
                handleResponse({'status': status, 'result': results}, callback);
            });
        }

        function handleResponse(response, callback) {
            this.options.lookupSection.find('.has-error').removeClass('has-error').find('.help-block').remove();
            if (response.status == google.maps.GeocoderStatus.OK) {
                callback(filterResult(response.result));
            } else {
                this.newSearch = true;
                this.options.lookupSection.find('.form-group').addClass('has-error')
                    .append('<span class="help-block margin-bottom-0">Unable to resolve your location, please try again.</span>')
            }
        }

        function filterResult(results) {
            var address = {};
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

        function handleAddress(address) {
            fillForm(address);
            this.options.lookupSection.toggleClass('hidden');
            this.options.addressSection.toggleClass('hidden');
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
            $.ajax({
                type: 'POST',
                url: $form.attr('action'),
                data: $form.serialize(),
                dataType: 'JSON',
                success: function(data) {
                    $modal.modal('hide');
                    that.options.onSubmit(data);
                },
                error: function(data){
                    that.options.addressSection.find('.has-error').removeClass('has-error').find('.help-block').remove();
                    $.each(data.responseJSON, function(key, value) {
                        that.options.addressSection.find('#' + key).parent().addClass('has-error').append('<span class="help-block">' + value + '</span>');
                    });
                }
            });
        }
    };
}(jQuery));