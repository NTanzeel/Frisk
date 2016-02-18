@extends('layouts.dashboard.index')

@section('title', 'View Item')

@section('style')
    @parent
    <link href="{{ URL::asset('assets/css/themes/default/dashboard/items.css') }}" rel="stylesheet">
@stop

@section('page-title', 'View Item')

@section('breadcrumb')
    <li><a href="{{ route('items::edit', [$item->id]) }}">{{ $item->name }}</a></li>
@stop

@section('content')
    <ul class="nav nav-tabs">
        <li class="active"><a data-target="#edit" data-toggle="tab">Edit</a></li>
        <li><a data-target="#resources" data-toggle="tab">Resources</a></li>
    </ul>
    <div class="page-content">
        <div class="tab-content">
            <div class="tab-pane active" id="edit">
                @if(session('response'))
                    <div class="alert {{ session('response')['success'] ? 'alert-success' : 'alert-danger' }}" role="alert">
                        {{ session('response')['message'] }}
                    </div>
                @endif

                @include('items.partials.form', [
                    'options'   => ['route' => ['items::save', $item->id], 'files' => false],
                    'defaults'  => ['location' => $locations],
                    'model'     => $item
                ])
            </div>
            <div class="tab-pane" id="resources">Resources</div>
        </div>
    </div>
@endsection
