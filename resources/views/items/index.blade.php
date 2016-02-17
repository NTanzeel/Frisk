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
    @if(count($items))
        <div id="saved-items" class="items row">
            @foreach($items as $item)
                <div class="col-md-4">
                    <div class="item">
                        <button type="button" class="delete" data-for="#location-{{ $item->id }}" data-target="{{ route('items::delete', [$item->id]) }}" data-token="{{ csrf_token() }}">
                            <i class="fa fa-trash-o"></i>
                        </button>
                        <div class="item-image" style="background-image: url({{ URL::asset($item->resources[0]->path . '/' . $item->resources[0]->name) }})"></div>
                        <div class="item-name">
                            {{ $item->name }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
