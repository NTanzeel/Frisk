@extends('layouts.dashboard.index')

@section('title', 'My Items')

@section('content')
    <h3 class="page-header">My Items</h3>
    @if(count($items))
        @foreach($items as $item)

        @endforeach
    @endif
@endsection
