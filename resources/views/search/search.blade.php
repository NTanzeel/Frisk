@extends('layouts.default.page')

@section('title', 'Search')

@section('style')
    @parent
    <link href="{{ URL::asset('assets/css/themes/default/page/search.css') }}" rel="stylesheet">
@stop

@section('content')
    <div class="page-content">
        @if(count($results) > 0)
            <div class="search-results">
                <div class="row">
                    @include('search.partials.listing', ['results' => $results, 'ipr' => 4])
                </div>
            </div>
        @else
            <div class="text-center">
                <p>
                    Sorry, we couldn't find any results matching your search query.
                </p>
            </div>
        @endif
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