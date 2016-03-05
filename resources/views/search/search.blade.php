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
                @include('search.partials.listing', ['results' => $results, 'ipr' => 4])
            </div>
        @else
            <div class="text-center">
                No Results :(
            </div>
        @endif
    </div>
@stop