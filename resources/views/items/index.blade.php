@extends('layouts.dashboard.index')

@section('title', 'My Items')

@section('content')
    <h3 class="page-header">My Items <a href="{{ route('items::create') }}">New</a></h3>
    @if(count($items))
        @foreach($items as $item)
            {!! '<pre>' . var_export($item, true) . '</pre>' !!}
        @endforeach
    @endif
@endsection
