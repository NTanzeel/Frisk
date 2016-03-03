<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modal-title">Edit Resource</h4>
        </div>
        <div class="modal-body">
            {{ Form::open(['route' => ['resources::save', $resource->id], 'method' => 'PUT', 'class' => 'form-horizontal']) }}
                <div class="form-group {{ !$typeToggle ? 'margin-bottom-0' : '' }}">
                    {!! Form::label('alias', 'Name', ['class' => 'col-md-2 control-label']) !!}
                    <div class="col-md-10">
                        {!! Form::text('alias', $resource->alias, ['placeholder' => 'Cover Photo', 'class' => 'form-control']) !!}
                    </div>
                </div>
                @if ($typeToggle)
                    <div class="form-group margin-bottom-0">
                        {!! Form::label('type', 'Type', ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-10">
                            <label class="radio-inline">
                                {{ Form::radio('type', \App\Models\Resource::$PRIVATE, $resource->type == \App\Models\Resource::$PRIVATE) }} Private
                            </label>
                            <label class="radio-inline">
                                {{ Form::radio('type', \App\Models\Resource::$PUBLIC, $resource->type == \App\Models\Resource::$PUBLIC) }} Public
                            </label>
                            {{--<div class="checkbox">--}}
                                {{--<label>--}}
                                    {{--{{ Form::checkbox('type', 1, $resource->type == \App\Models\Resource::$PUBLIC) }} Show this image to everyone if I report this item as stolen.--}}
                                {{--</label>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                @endif
            {{ Form::close() }}
        </div>
        <div class="modal-footer">
            <button id="modal-save" type="submit" class="btn btn-info">Save</button>
            <button id="modal-close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>