@extends('layouts.default.index')

@section('style')
    @parent
    <link href="{{ URL::asset('assets/css/themes/default/page/global.css') }}" rel="stylesheet">
@stop

@section('header')
    @include('layouts.default.partials.header')
@stop

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @yield('content')
            </div>
        </div>
    </div>
@stop