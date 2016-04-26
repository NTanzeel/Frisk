<div id="{{ $type }}-messages" class="messages">
    @foreach($messages as $message)
        <div id="message-{{ $message->id }}-wrapper">
            <div  id="message-{{ $message->id }}" class="row message {{ $type == 'received' ? ($message->seen_at ? 'read' : 'unread') : 'read' }}" href="{{ route('messages::view', [$message->id]) }}">
                <div class="col-md-{{ $type == 'received' ? '6' : '7' }} subject">
                    <label class="checkbox-inline no-redirect">
                        <input type="checkbox" id="select_{{ $message->id }}" class="select-message" value="{{ $message->id }}"> Re: {{ $message->regarding->item->name }}
                    </label>
                </div>
                <div class="col-md-2 name hidden-sm hidden-xs">
                    {{ $message->{$type == 'sent' ? 'recipient' : 'sender'}->name }}
                </div>
                <div class="col-md-2 date hidden-sm hidden-xs">
                    {{ $message->created_at->format('j/m/Y h:i:s A') }}
                </div>
                <div class="col-md-{{ $type == 'received' ? '2' : '1' }} actions hidden-sm hidden-xs">
                    <a class="delete action no-redirect" data-for="#message-{{ $message->id }}" data-target="{{ route('messages::delete', [$message->id]) }}" data-token="{{ csrf_token() }}">
                        <i class="fa fa-trash-o"></i>
                    </a>
                    @if ($type == 'received')
                        <a class="action no-redirect" href="{{ route('messages::reply', [$message->id]) }}">
                            <i class="fa fa-mail-reply"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>