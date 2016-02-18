@extends('layouts.default.index')

@section('style')
    @parent
    <link href="{{ URL::asset('assets/css/themes/default/dashboard/global.css') }}" rel="stylesheet">
@stop

@section('container')
    <div id="wrapper">
        <div id="sidebar-wrapper">
            @include('layouts.dashboard.partials.sidebar')
        </div>
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-header">
                            <button type="button" class="navbar-toggle sidebar-toggle" data-toggle="collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <div class="heading-text">
                                @yield('page-title')
                            </div>
                            @yield('page-actions')
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @eval($url = '/')
                        <ol class="breadcrumb">
                            <li><a href="{{ url($url) }}">Frisk</a></li>
                            @foreach(Request::segments() as $segment)
                                @if (is_numeric($segment))
                                    @eval(break)
                                @endif
                                <li><a href="{{ url($url .= $segment . '/') }}">{{ ucwords($segment) }}</a></li>
                            @endforeach
                            @yield('breadcrumb')
                        </ol>
                    </div>
                </div>
                {{--<div class="row">--}}
                    {{--<div class="col-md-6 col-md-offset-3 col-sm-12 col-sm-offset-0">--}}
                        {{--<div id="notification-slider" class="alert alert-danger" role="alert"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="row">
                    <div class="col-sm-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ URL::asset('assets/js/dashboard/common.js') }}"></script>
    <script async defer type="text/javascript" src="{{ URL::asset('assets/js/dashboard/navigation.js') }}"></script>
@stop