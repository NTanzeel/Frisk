@extends('layouts.default.index')

@section('style')
    @parent
    <link href="{{ URL::asset('assets/css/themes/default/dashboard/global.css') }}" rel="stylesheet">
@stop

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                @include('layouts.dashboard.partials.sidebar')
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 page-container">
                @yield('content')
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @parent
    <script async defer type="text/javascript" src="{{ URL::asset('assets/js/dashboard/navigation.js') }}"></script>
@stop