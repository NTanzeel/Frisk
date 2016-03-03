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