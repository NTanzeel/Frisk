@extends('layouts.dashboard.index')

@section('title', 'Register Item')

@section('page-title', 'My Items')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(['route' => 'items::store', 'files' => true]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['placeholder' => 'e.g. Play Station 4', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('identifier', 'Identifier') !!}
            {!! Form::text('identifier', null, ['placeholder' => 'e.g. Serial Number', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('location', 'Location') !!}
            {!! Form::select('location', $locations, 'Please Select', ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description') !!}
            {!! Form::textarea('description', null, ['placeholder' => 'e.g. There is a small scratch on the back.', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('coverImage', 'Image') !!}
            {!! Form::file('coverImage', ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection
