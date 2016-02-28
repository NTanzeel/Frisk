{!! Form::open(array_merge($options, ['method' => (isset($model) ? 'put' : 'post')])) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', isset($model) ? $model->name : null, ['placeholder' => 'e.g. Play Station 4', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('identifier', 'Identifier') !!}
        {!! Form::text('identifier', isset($model) ? $model->identifier : null, ['placeholder' => 'e.g. Serial Number', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('location', 'Location') !!}
        {!! Form::select('location', $defaults['location'],  isset($model) ? $model->location_id : 'Please Select', ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('value', 'Value') !!}
        {!! Form::text('value', isset($model) ? $model->value : null, ['placeholder' => '19.99', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('description', 'Description') !!}
        {!! Form::textarea('description', isset($model) ? $model->description : null, ['placeholder' => 'e.g. There is a small scratch on the back.', 'class' => 'form-control']) !!}
    </div>

    @if(!isset($model))
        <div class="form-group">
            {!! Form::label('coverImage', 'Image') !!}
            {!! Form::file('coverImage', ['class' => 'form-control']) !!}
        </div>
    @endif

    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}