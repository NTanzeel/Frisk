@extends('layouts.default.page')

@section('title', 'Near Me')

@section('style')
    @parent
    <link href="{{ URL::asset('assets/css/themes/default/page/search.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/themes/default/page/near.css') }}" rel="stylesheet">
@stop

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
                                    <li><a href="?order=name&sort=ASC">Name - Ascending</a></li>
                                    <li><a href="?order=name&sort=DESC">Name - Descending</a></li>
                                    <li><a href="?order=distance&sort=ASC">Distance - Ascending</a></li>
                                    <li><a href="?order=distance&sort=DESC">Distance - Descending</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="search-results">
                <div class="container-fluid">
                    <div class="row">
                        @if(count($results) > 0)
                            @include('search.partials.listing', ['results' => $results, 'ipr' => 2])
                        @else
                            <div class="col-md-12 text-center">
                                No Results :(
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <section class="map-view hidden-sm">

        </section>
    </div>
@stop

@section('footer')
    @parent
    @include('search.partials.popup')
@stop

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ URL::asset('assets/js/page/search.js') }}"></script>
@stop