@extends('layouts.default.index')

@section('style')
    @parent
    <link href="{{ URL::asset('assets/css/themes/default/page/global.css') }}" rel="stylesheet">
@stop

@section('header')
    @include('layouts.default.partials.header')
@stop

@section('container')
    <div class="container-fluid" style="margin-top: 15px">
        @yield('content')
    </div>
@stop