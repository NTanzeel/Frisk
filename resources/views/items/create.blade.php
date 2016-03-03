@extends('layouts.dashboard.index')

@section('title', 'Register Item')

@section('page-title', 'My Items')

@section('content')
    <div class="page-content">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @include('items.partials.form', [
            'options'   => ['route' => ['items::store'], 'files' => true],
            'defaults'  => ['location' => $locations]
        ])
    </div>
@endsection
