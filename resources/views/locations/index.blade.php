@extends('layouts.dashboard.index')

@section('title', 'My Locations')

@section('style')
    @parent
    <link href="{{ URL::asset('assets/css/themes/default/dashboard/locations.css') }}" rel="stylesheet">
@stop

@section('content')
    <h3 class="page-header">
        Locations
        @include('locations.partials.createFormLink', ['text' => 'New Location'])
    </h3>
    <div class="locations row">
        @forelse($locations as $key => $location)
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-default stored-location">
                    <div class="panel-heading">{!! $location->door_no . ', ' . $location->first_address_line . ', ' . $location->postcode !!}</div>
                    <div class="panel-body">
                        <div class="map" data-latitude="{!! $location->latitude !!}" data-longitude="{!! $location->longitude !!}">

                        </div>
                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>
    @include('locations.partials.createForm')
@stop

@section('scripts')
    @parent
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASGCfgteFuvjCkXtXq9lTWgtCRW0qrcsw"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/dashboard/AddressLookup.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.stored-location .map').each(function(key, element) {
                addMap(element);
            });

            $('#newLocationForm').AddressLookup({
                ajaxSubmit : true,
                onSubmit : function(address) {
                    var maps = $('<div class="col-sm-6 col-md-4">' +
                            '<div class="panel panel-default stored-location">' +
                            '<div class="panel-heading">' + address.door_no + ', ' + address.first_address_line + ', ' + address.postcode + '</div>' +
                            '<div class="panel-body">' +
                            '<div class="map" data-latitude="' + address.latitude + '" data-longitude="' + address.longitude + '">' +
                            '</div>' +
                            '</div>' +
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
        })
    </script>
@stop