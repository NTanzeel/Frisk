@extends('layouts.dashboard.index')

@section('title', 'Messages')

@section('style')
    @parent
    <link href="{{ URL::asset('assets/css/themes/default/dashboard/messages.css') }}" rel="stylesheet">
@stop

@section('page-title', 'Messages')

@section('content')
    <ul class="nav nav-tabs">
        <li class="active"><a data-target="#inbox" data-toggle="tab">Inbox</a></li>
        <li><a data-target="#sent" data-toggle="tab">Sent</a></li>
        <li class="pull-right">
            <div class="dropdown">
                <a id="actionsMenu" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Actions
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="actionsMenu">
                    <li>
                        <a class="no-redirect" href="#" id="delete-selected">Delete</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="inbox">
            @include('messages.partials.listing', ['messages' => $received, 'type' => 'received'])
        </div>
        <div class="tab-pane" id="sent">
            @include('messages.partials.listing', ['messages' => $sent, 'type' => 'sent'])
        </div>
    </div>
@stop

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ URL::asset('assets/js/dashboard/messages.js') }}"></script>
@stop