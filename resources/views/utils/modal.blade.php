{{--{{ dd(get_defined_vars()['__data']) }}--}}
<div class="modal fade" {!! isset($id) ? 'id="' . $id . '"' : '' !!} tabindex="-1" role="dialog" aria-labelledby="modal-title">
    @if (!$blank)
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-title">{{ $title }}</h4>
                </div>
                <div class="modal-body">
                    {!! isset($content) ? $content : '' !!}
                </div>
                @if(isset($buttons))
                    <div class="modal-footer">
                        @foreach($buttons as $button)
                            <button {!! isset($button['id']) ? 'id="' . $button['id'] . '"' : '' !!} type="button" class="btn btn-{{ isset($button['class']) ? $button['class'] : 'default' }}" {!! !empty($button['dismiss']) ? 'data-dismiss="modal"' : '' !!}>{{ $button['text'] }}</button>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>