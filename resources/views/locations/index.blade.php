@extends('layouts.dashboard.index')

@section('title', 'My Locations')

@section('style')
    @parent
    <link href="{{ URL::asset('assets/css/themes/default/dashboard/locations.css') }}" rel="stylesheet">
@stop


@section('page-title', 'Saved Locations')

@section('page-actions')
    <ul class="page-actions">
        <li>
            <a href="#" data-toggle="modal" data-target="#createLocationModal">
                <span class="glyphicon glyphicon-plus"></span> New
            </a>
        </li>
    </ul>
@stop

@section('content')
    <div class="page-content">
        <div id="saved-locations" class="row">
            @forelse($locations as $key => $location)
                <div class="col-sm-6 col-md-4">
                    <div id="location-{{ $location->id }}" class="content-box location">
                        <ul class="list-inline action-list top-right">
                            <li>
                                <a class="delete" data-for="#location-{{ $location->id }}" data-target="{{ route('locations::delete', [$location->id]) }}" data-token="{{ csrf_token() }}">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="content-body">
                            <div class="map" data-latitude="{!! $location->latitude !!}" data-longitude="{!! $location->longitude !!}"></div>
                        </div>
                        <div class="content-label">{!! $location->first_address_line . ', ' . $location->postcode !!}</div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
    @include('locations.partials.form')
@stop

@section('pre-scripts')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASGCfgteFuvjCkXtXq9lTWgtCRW0qrcsw"></script>
@stop

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ URL::asset('assets/js/library/maps.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            Frisk.init({
                deleteToken: '{{ csrf_token() }}',
                deletePath : '{{ route('locations::delete', ['id']) }}'
            });

            Maps.init({
                map_marker : '{{ URL::asset('assets/img/icons/map_marker.png') }}'
            })
        })
    </script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/dashboard/AddressLookup.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/dashboard/locations.js') }}"></script>
@stop