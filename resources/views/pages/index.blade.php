@extends('layouts.default.page')

@section('title', 'Home')

@section('style')
    @parent
    <link href="{{ URL::asset('assets/css/themes/default/page/index.css') }}" rel="stylesheet">
@stop

@section('container')
    <section class="header-section">
        <div id="crimes_near_by" class="map" data-latitude="52.38167946424569" data-longitude="-1.5618637662616455">

        </div>
        <div id="search_container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <form id="search_form" class="search-form" action="{{ route('search::index') }}" method="get">
                            <label for="search_query" class="sr-only">Search</label>
                            <div class="input-group">
                                <input type="text" id="search_query" name="query" class="form-control" placeholder="Enter a name or serial number" />
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" type="submit">Search!</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('pre-scripts')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASGCfgteFuvjCkXtXq9lTWgtCRW0qrcsw"></script>
@stop

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ URL::asset('assets/js/library/maps.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            Maps.init({
                map_marker: '{{ URL::asset('assets/img/icons/map_marker.png') }}'
            });
        })
    </script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/page/index.js') }}"></script>
@stop