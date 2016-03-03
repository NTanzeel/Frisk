@extends('layouts.default.page')

@section('title', 'Near Me')

@section('style')
    @parent
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
                            @foreach($results as $result)
                                <div class="col-md-6">
                                    <div class="search-result">
                                        <div class="result-body">
                                            <div id="item-carousel-{{ $result->item->id }}" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner" role="listbox">
                                                    @foreach($result->item->resources as $key => $resource)
                                                        <div class="item {{$key == 0 ? 'active' : ''}}">
                                                            <a href="#" class="contained-image" style="background-image: url('{{ URL::asset($resource->path . '/' . $resource->name) }}');"></a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @if (count($result->item->resources) > 1)
                                                    <a class="left carousel-control" href="#item-carousel-{{ $result->item->id }}" role="button" data-slide="prev">
                                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="right carousel-control" href="#item-carousel-{{ $result->item->id }}" role="button" data-slide="next">
                                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="distance">
                                                {{ $result->distance > 0 ? $result->distance : '1' }} <span class="unit small">KM</span>
                                            </div>
                                        </div>
                                        <div class="result-footer">
                                            <a class="name" href="#">
                                                {{ $result->item->name }}
                                            </a>
                                            <a class="serial small" href="#">
                                                Identifier: {{ $result->item->identifier }}
                                            </a>
                                            <div class="user-initials">
                                                @eval($initials = explode(' ', $result->item->user->name))
                                                {{ substr($initials[0], 0, 1) . substr($initials[count($initials) - 1], 0, 1) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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

{{--@section('content')--}}
    {{--<div class="row">--}}
        {{--@if(count($results) > 0)--}}
            {{--<div class="col-md-6">--}}
                {{--<div class="row">--}}
                    {{--@foreach($results as $result)--}}
                        {{--<div class="col-md-6">--}}
                            {{--<div class="panel panel-default">--}}
                                {{--<div class="panel-heading">--}}
                                    {{--{{ $result->item->name }} - {{ $result->distance ? $result->distance : 'Less Than 1' }} KM--}}
                                {{--</div>--}}
                                {{--<div class="panel-body">--}}
                                    {{--<img src="{{ URL::asset($result->item->resources[0]->path . '/' . $result->item->resources[0]->name) }}" width="100%" />--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@endforeach--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-6 hidden-sm">--}}

            {{--</div>--}}
        {{--@else--}}
            {{--<div class="col-md-12 text-center">--}}
                {{--No Results :(--}}
            {{--</div>--}}
        {{--@endif--}}
    {{--</div>--}}
{{--@stop--}}