@extends('layouts.dashboard.index')

@section('title', 'View Message')

@section('style')
    @parent
    <link href="{{ URL::asset('assets/css/themes/default/dashboard/messages.css') }}" rel="stylesheet">
@stop

@section('page-title', 'Messages')

@if ($type == 'received')
    @section('page-actions')
        <ul class="page-actions">
            <li>
                <a href="{{ route('messages::reply', [$message->id]) }}">
                    <span class="fa fa-reply"></span> Reply
                </a>
            </li>
        </ul>
    @stop
@endif
@section('breadcrumb')
    <li><a href="{{ route('messages::create', [$message->stolen_item_id]) }}">Re: {{ $message->regarding->item->name }}</a></li>
@stop

@section('content')
    <div class="page-content">
        {{--<div class="message-actions">--}}
            {{--<div class="btn-group">--}}
                {{--<a href="#" class="btn btn-default">Reply</a>--}}
                {{--<a href="#" class="btn btn-info">Mark as Unread</a>--}}
            {{--</div>--}}
            {{--<div class="btn-group pull-right">--}}
                {{--<a href="#" class="btn btn-danger">Delete</a>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="user-initials">--}}
            {{--@eval($initials = explode(' ', $message->se->user->name))--}}
            {{--{{ substr($initials[0], 0, 1) . substr($initials[count($initials) - 1], 0, 1) }}--}}
        {{--</div>--}}
        <div class="view-message">
            <div class="message-header">
                <div class="recipient">
                    <label>To:</label> {{ $message->recipient->name }}
                </div>
                <div class="sender">
                    <label>From:</label> {{ $message->sender->name }}
                </div>
                <div class="subject">
                    <label>Subject:</label> {{ $message->regarding->item->name }}
                </div>
            </div>
            <div class="message-body">
                {!! nl2br(htmlentities($message->content)) !!}
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ URL::asset('assets/js/dashboard/messages.js') }}"></script>
@stop