@extends('layouts.dashboard.index')

@section('title', 'View Message')

@section('style')
    @parent
    <link href="{{ URL::asset('assets/css/themes/default/dashboard/messages.css') }}" rel="stylesheet">
@stop

@section('page-title', 'Messages')

@section('breadcrumb')
    <li><a href="{{ route('messages::create', [$item->id]) }}">Re: {{ $item->item->name }}</a></li>
@stop

@section('content')
    <div class="page-content">
        {{ Form::open(['route' => ['messages::store', $item->id]]) }}
            <div class="view-message">
                <div class="message-header">
                    <div class="recipient">
                        <label>To:</label> {{ $recipient->name }}
                    </div>
                    <div class="sender">
                        <label>From:</label> {{ $sender->name  }}
                    </div>
                    <div class="subject">
                        <label>Subject:</label> {{ $item->item->name }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="content" class="sr-only">Content</label>
                    {{ Form::textarea('content', null, ['class' => 'form-control', 'maxlength' => 1000, 'placeholder' => 'Enter a message']) }}
                </div>
            </div>
            {{ Form::submit('Send Message', ['class' => 'btn btn-info']) }}
        {{ Form::close() }}
    </div>
@stop

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ URL::asset('assets/js/dashboard/messages.js') }}"></script>
@stop