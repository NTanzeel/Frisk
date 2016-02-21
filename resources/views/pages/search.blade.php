@extends('layouts.default.page')

@section('title', 'Search')

@section('content')
    <div class="row">
        @if(count($items) > 0)
            <div class="col-md-6">
                <div class="row">
                    @foreach($items as $item)
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    {{ $item->name }} - {{ $item->distance }}KM
                                </div>
                                <div class="panel-body">
                                    <img src="{{ URL::asset($item->resources[0]->path . '/' . $item->resources[0]->name) }}" width="100%" />
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6 hidden-sm">

            </div>
        @else
            <div class="col-md-12 text-center">
                No Results :(
            </div>
        @endif
    </div>
@stop