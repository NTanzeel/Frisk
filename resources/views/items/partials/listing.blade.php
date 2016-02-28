@if(count($items))
    <div class="row">
        @foreach($items as $item)
            <div class="col-md-4">
                <div {{ isset($prefix) ? 'id="' . $prefix . '-' . $item->id . '"' : '' }} class="content-box item item-{{ $item->id }}">
                    <ul class="list-inline action-list top-right">
                        <li>
                            <a class="edit" href="{{ route('items::edit', [$item->id]) }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </li>
                        <li>
                            <a class="delete" data-for=".item-{{ $item->id }}" data-target="{{ route('items::delete', [$item->id]) }}" data-token="{{ csrf_token() }}">
                                <i class="fa fa-trash-o"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="content-body">
                        <div class="item-image" style="background-image: url('{{ URL::asset($item->resources[0]->path . '/' . $item->resources[0]->name) }}')"></div>
                    </div>
                    <div class="content-label item-name">
                        {{ $item->name }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif