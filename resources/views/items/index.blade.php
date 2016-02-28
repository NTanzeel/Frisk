@extends('layouts.dashboard.index')

@section('title', 'My Items')

@section('style')
    @parent
    <link href="{{ URL::asset('assets/css/themes/default/dashboard/items.css') }}" rel="stylesheet">
@stop

@section('page-title', 'My Items')

@section('page-actions')
    <ul class="page-actions">
        <li>
            <a href="{{ route('items::create') }}">
                <span class="glyphicon glyphicon-plus"></span> New
            </a>
        </li>
    </ul>
@stop

@section('content')
    <ul class="nav nav-tabs">
        <li class="active"><a data-target="#all-Items" data-toggle="tab">All</a></li>
        <li><a data-target="#private-items" data-toggle="tab">Private</a></li>
        <li><a data-target="#stolen-items" data-toggle="tab">Reported</a></li>
    </ul>
    <div class="page-content">
        <div class="tab-content">
            <div class="tab-pane active" id="all-Items">
                @include('items.partials.listing', ['items' => $items, 'prefix' => 'item-'])
                {!! $items->render() !!}
            </div>
            <div class="tab-pane" id="private-items">
                @include('items.partials.listing', ['items' => $private, 'prefix' => 'private-item-'])
            </div>
            <div class="tab-pane" id="stolen-items">
                @include('items.partials.listing', ['items' => $stolen, 'prefix' => 'stolen-item-'])
            </div>
        </div>
    </div>
@endsection
