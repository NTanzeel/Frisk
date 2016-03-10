@extends('layouts.default.page')

@section('title', 'Near Me')

@section('style')
    @parent
    <link href="{{ URL::asset('assets/css/themes/default/page/search.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/themes/default/page/near.css') }}" rel="stylesheet">
@stop

@if(count($results) > 0)
    @section('container')
        <div class="wrapper">
            <section class="grid-section">
                <div class="search-actions">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="dropdown pull-right">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="orderBy" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Order By ({{ ucfirst($order) . ' - ' . ($sort == 'ASC' ? 'Ascending' : 'Descending') }})
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="orderBy">
                                        <li><a href="{{ route('search::near', [$latitude, $longitude, 'order' => 'name', 'sort' => 'ASC']) }}">Name - Ascending</a></li>
                                        <li><a href="{{ route('search::near', [$latitude, $longitude, 'order' => 'name', 'sort' => 'DESC']) }}">Name - Descending</a></li>
                                        <li><a href="{{ route('search::near', [$latitude, $longitude, 'order' => 'distance', 'sort' => 'ASC']) }}">Distance - Ascending</a></li>
                                        <li><a href="{{ route('search::near', [$latitude, $longitude, 'order' => 'distance', 'sort' => 'DESC']) }}">Distance - Descending</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search-results">
                    <div class="container-fluid">
                        <div class="row">
                            @include('search.partials.listing', ['results' => $results, 'ipr' => 2])
                        </div>
                    </div>
                </div>
            </section>
            <section class="map-view hidden-sm hidden-xs">
                <div id="near_me_map" class="map" data-latitude="{{ $latitude }}" data-longitude="{{ $longitude }}"></div>
            </section>
        </div>
    @stop
@else
    @section('content')
        <div class="page-content">
            <div class="text-center">
                <p>
                    Great news! No items have been reported as stolen around you!
                </p>
            </div>
        </div>
    @stop
@endif

@section('footer')
    @parent
    @include('search.partials.popup')
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
                messageRoute: '{{ route('messages::create', [':id']) }}',
                {!! 'markers : ' . json_encode($markers) !!}
            });

            Maps.init({
                map_marker : '{{ URL::asset('assets/img/icons/map_marker.png') }}'
            });
        })
    </script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/page/search.js') }}"></script>
@stop