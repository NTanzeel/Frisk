<div class="panel-group" id="item-resources" role="tablist" aria-multiselectable="true">
    @foreach($groups as $key => $group)
        <div id="{{ $key }}-resources" class="panel panel-default panel-collapsible">
            <div class="panel-heading" role="tab" id="{{ $key }}-resources-heading">
                <h4 class="panel-title">
                    <a class="clear-default no-hover {{ $key == 'all' ? 'collapsed' : '' }}" role="button" data-toggle="collapse" href="#{{ $key }}-resources-collapse" aria-controls="{{ $key }}-resources-collapse">
                        {{ ucwords($key) }} <span class="caret pull-right"></span>
                    </a>
                </h4>
            </div>
            <div id="{{ $key }}-resources-collapse" class="panel-collapse collapse {{ $key == 'all' ? '' : 'in' }}" role="tabpanel" aria-labelledby="{{ $key }}-resources-heading" >
                <div class="panel-body">
                    <div class="row">
                        @include('resources.partials.listing', ['resources' => $group])
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>