@foreach($results as $result)
    <div class="col-md-{{ 12 / $ipr }}">
        <div id="reported-item-{{ $result->id }}" class="search-result">
            <div class="result-body">
                <div id="item-carousel-{{ $result->item->id }}" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @foreach($result->item->resources as $key => $resource)
                            <div class="item {{$key == 0 ? 'active' : ''}}">
                                <a href="{{ route('search::view', [$result->id]) }}" class="show-item contained-image" style="background-image: url('{{ URL::asset($resource->path . '/' . $resource->name) }}');"></a>
                            </div>
                        @endforeach
                    </div>
                    @if (count($result->item->resources) > 1)
                        <a class="left carousel-control" href="#item-carousel-{{ $result->item->id }}" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#item-carousel-{{ $result->item->id }}" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    @endif
                </div>
                <div class="distance">
                    {{ $result->distance > 0 ? $result->distance : '1' }} <span class="unit small">KM</span>
                </div>
            </div>
            <div class="result-footer">
                <a class="name show-item" href="{{ route('search::view', [$result->id]) }}">
                    {{ $result->item->name }}
                </a>
                <a class="serial small show-item " href="{{ route('search::view', [$result->id]) }}">
                    Identifier: {{ $result->item->identifier }}
                </a>
                <div class="user-initials">
                    @eval($initials = explode(' ', $result->item->user->name))
                    {{ substr($initials[0], 0, 1) . substr($initials[count($initials) - 1], 0, 1) }}
                </div>
            </div>
        </div>
    </div>
@endforeach