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
        <li><a data-target="#manage" data-toggle="tab">Manage</a></li>
        <li><a data-target="#report" data-toggle="tab">Report</a></li>
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
            <div class="tab-pane" id="manage">
                <div class="row">
                    @foreach($item->resources as $resource)
                        <div class="col-md-3">
                            <div class="content-box item item-{{ $resource->id }}">
                                <ul class="list-inline action-list top-right">
                                    <li>
                                        <a class="edit" href="{{ route('items::edit', [$resource->id]) }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="delete" data-for=".item-{{ $resource->id }}" data-target="{{ route('items::delete', [$resource->id]) }}" data-token="{{ csrf_token() }}">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </li>
                                </ul>
                                <div class="content-body">
                                    <div class="item-image" style="background-image: url('{{ URL::asset($resource->path . '/' . $resource->name) }}')"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane" id="report">
                {{ Form::open(['route' => ['items::toggle', $item->id], 'method' => 'post']) }}
                    @if (!$item->stolenRecord)
                        <div class="form-group">
                            {!! Form::label('theft-location', 'Location') !!}
                            {!! Form::select('location', $locations, 'Please Select', ['id' => 'theft-location', 'class' => 'form-control']) !!}
                        </div>

                        {!! Form::submit('Mark As Stolen', ['class' => 'btn btn-primary']) !!}
                    @else
                        {!! Form::submit('Mark As Recovered', ['class' => 'btn btn-primary btn-block']) !!}
                    @endif
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
