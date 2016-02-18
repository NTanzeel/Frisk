@extends('layouts.dashboard.index')

@section('title', 'View Item')

@section('style')
    @parent
    <link href="{{ URL::asset('assets/css/themes/default/dashboard/items.css') }}" rel="stylesheet">
@stop

@section('page-title', 'View Item')

@section('breadcrumb')
    <li><a href="{{ route('items::view', [$item->id]) }}">{{ $item->name }}</a></li>
@stop

@section('content')
    <div class="page-content">
        <div id="view-item" class="row">
            <div class="col-md-6">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="{{ URL::asset($item->resources[0]->path . '/' . $item->resources[0]->name) }}" alt="Cover Image">
                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        @eval(dump($item))
    </div>
@endsection
