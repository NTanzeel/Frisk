@foreach($resources as $resource)
    <div class="col-md-3">
        <div class="content-box resource resource-{{ $resource->id }}">
            <ul class="list-inline action-list top-right">
                <li>
                    <a class="edit" href="#" data-toggle="modal" data-ajax="true" data-target="#ajax-modal" data-source="{{ route('resources::edit', [$resource->id]) }}" data-save="true">
                        <i class="fa fa-pencil"></i>
                    </a>
                </li>
                <li>
                    <a class="delete" data-for=".resource-{{ $resource->id }}" data-target="{{ route('resources::delete', [$resource->id]) }}" data-token="{{ csrf_token() }}">
                        <i class="fa fa-trash-o"></i>
                    </a>
                </li>
            </ul>
            <div class="content-body">
                <div class="resource-image" style="background-image: url('{{ URL::asset($resource->path . '/' . $resource->name) }}')"></div>
            </div>
            <div class="content-label">
                {{ $resource->alias }}
            </div>
        </div>
    </div>
@endforeach