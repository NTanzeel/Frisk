{{--<div class="modal-dialog" role="document">--}}
    {{--<div class="modal-content">--}}
        {{--<div class="modal-header">--}}
            {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
            {{--<h4 class="modal-title" id="modal-title">Upload Resource</h4>--}}
        {{--</div>--}}
        {{--<div class="modal-body">--}}
            {{--<form action="{{ route('resources::store') }}" class="dropzone" id="my-awesome-dropzone"></form>--}}
        {{--</div>--}}
        {{--<div class="modal-footer">--}}
            {{--<button id="modal-save" type="button" class="btn btn-info" data-dismiss="modal">Done</button>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

<form id="resources-dz" class="dropzone" action="{{ route('resources::store') }}" data-item="{{ $item->id }}" data-token="{{ csrf_token() }}"></form>