$(document).ready(function() {

    var mapElement = $('.map').get(0);
    var $modal = $('#show-item-modal');

    if (mapElement) {
        var map = Maps.createRaw($(mapElement).attr('id'), mapElement, {
            center: {lat: $(mapElement).data('latitude'), lng: $(mapElement).data('longitude')},
            zoom: 10,
            streetViewControl: false,
            styles: [{
                featureType: "all",
                elementType: "labels",
                stylers: [{visibility: "off"}]
            }]
        });

        Maps.addMarkers(map, Frisk.get('markers'));
    }

    if ($modal) {
        $('.show-item').on('click', function(event) {
            event.preventDefault();
            $.getJSON($(this).attr('href'), showPopup);
        });

        function showPopup(data) {
            $modal.find('.modal-title').text(data.item.name);
            $modal.find('.photos').html(getCarousel(data.id, data.item.resources));
            $modal.find('.description').text(data.item.description);
            $modal.find('.identifier').find('.text').text(data.item.identifier);
            $modal.find('.location').find('.text').text(data.location.postcode);
            $modal.find('.value').find('.text').text(data.item.value);
            $modal.find('.user').find('.text').text(data.item.user.name);
            $modal.find('.date').find('.text').text(data.created_at);
            $modal.find('.message').attr('href', Frisk.get('messageRoute').replace(':id', data.id));
            $modal.modal('show');
        }

        function getCarousel(id, items) {
            var $carousel = $('<div id="view-item-carousel-' + id + '" class="carousel slide" data-ride="carousel"></div>');

            var $items = $('<div class="carousel-inner" role="listbox"></div>');

            var $leftControl = $(
                '<a class="left carousel-control' + (items.length > 1 ? '' : ' hidden') + '" href="#view-item-carousel-' + id+ '" role="button" data-slide="prev">' +
                '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>' +
                '<span class="sr-only">Previous</span>' +
                '</a>'
            );

            var $rightControl = $(
                '<a class="right carousel-control' + (items.length > 1 ? '' : ' hidden') + '" href="#view-item-carousel-' + id + '" role="button" data-slide="next">' +
                '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>' +
                '<span class="sr-only">Next</span>' +
                '</a>'
            );

            $.each(items, function(key, item) {
                $items.append(
                    '<div class="item ' + (key == 0 ? 'active' : '') + '">' +
                    '<div class="image" style="background-image: url(' + item.path + '/' + item.name + ')">' +
                    '<img class="hidden visible-sm visible-xs" src="' + item.path + '/' + item.name + '" width="100%" />' +
                    '</div>' +
                    '</div>'
                );
            });

            $carousel.append($items).append($leftControl).append($rightControl);

            return $carousel;
        }
    }
});