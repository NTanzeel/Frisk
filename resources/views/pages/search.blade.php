@extends('layouts.default.page')

@section('title', 'Search')

@section('content')
    <div class="row">
        @if(count($results) > 0)
            <div class="col-md-6">
                <div class="row">
                    @foreach($results as $result)
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    {{ $result->item->name }}{{ isset($result->distance) ? (' - ' . ($result->distance ? $result->distance : 'Less Than 1') . 'KM') : '' }}
                                </div>
                                <div class="panel-body">
                                    <img src="{{ URL::asset($result->item->resources[0]->path . '/' . $result->item->resources[0]->name) }}" width="100%" />
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