@extends('layouts.dashboard.index')

@section('title', 'View Item')

@section('style')
    @parent
    <link href="{{ URL::asset('assets/css/dropzone/theme.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/themes/default/dashboard/items.css') }}" rel="stylesheet">
@stop

@section('page-title', 'View Item')

@section('breadcrumb')
    <li><a href="{{ route('items::edit', [$item->id]) }}">{{ $item->name }}</a></li>
@stop

@section('content')
    <ul class="nav nav-tabs">
        <li class="active"><a data-target="#edit" data-toggle="tab">Edit</a></li>
        <li><a data-target="#manage" data-toggle="tab">Resources</a></li>
        <li><a data-target="#report" data-toggle="tab">Report</a></li>
        <li class="pull-right">
            <div class="dropdown">
                <a id="actionsMenu" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Actions
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="actionsMenu">
                    <li>
                        <a href="#" data-toggle="modal" data-target="#upload-resource-modal">
                            Upload
                        </a>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{ route('items::remove', [$item->id]) }}">Delete</a></li>
                </ul>
            </div>
        </li>
    </ul>
    <div class="page-content">
        <div class="tab-content">
            <div class="tab-pane active" id="edit">
                @if(session('response'))
                    <div class="alert {{ session('response')['success'] ? 'alert-success' : 'alert-danger' }}" role="alert">
                        {{ session('response')['message'] }}
                    </div>
                @endif

                @include('items.partials.form', [
                    'options'   => ['route' => ['items::save', $item->id], 'files' => false],
                    'defaults'  => ['location' => $locations],
                    'model'     => $item
                ])
            </div>
            <div class="tab-pane" id="manage">
                @include('resources.index', ['groups' => $item->groupedResources()])
            </div>
            <div class="tab-pane" id="report">
                @include('stolen.create', ['item' => $item, 'locations' => $locations])
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
    @include('utils.modal', [
        'id' => 'ajax-modal', 'blank' => true
    ])

    @include('utils.modal', [
        'id' => 'upload-resource-modal',
        'blank' => false,
        'title' => 'Upload Resources',
        'content' => View::make('resources.create')->with('item', $item)->render(),
        'buttons' => [
            ['text' => 'Done', 'class' => 'info', 'dismiss' => true]
        ]
    ])
@stop

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ URL::asset('assets/js/library/dropzone.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/library/ajax-forms.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            Dropzone.autoDiscover = false;

            var form = $('#resources-dz');
            var dz = new Dropzone("#resources-dz", { url: form.attr('action')});

            dz.on('sending', function(file, xhr, formData) {
                formData.append('_token', form.data('token'));
                formData.append('item_id', form.data('item'));
            });

            dz.on('complete', function(response) {
                console.log(response);
            });
        });
    </script>
@stop