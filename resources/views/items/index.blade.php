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
    <div class="page-content">
        @if(count($items))
            <div id="saved-items" class="row">
                @foreach($items as $item)
                    <div class="col-md-4">
                        <div id="item-{{ $item->id }}" class="content-box item">
                            <ul class="list-inline action-list top-right">
                                <li>
                                    <a class="edit" href="{{ route('items::edit', [$item->id]) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="delete" data-for="#item-{{ $item->id }}" data-target="{{ route('items::delete', [$item->id]) }}" data-token="{{ csrf_token() }}">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </li>
                            </ul>
                            <div class="content-body">
                                <div class="item-image" style="background-image: url('{{ URL::asset($item->resources[0]->path . '/' . $item->resources[0]->name) }}')"></div>
                            </div>
                            <div class="content-label item-name">
                                {{ $item->name }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
