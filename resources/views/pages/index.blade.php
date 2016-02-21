@extends('layouts.default.page')

@section('title', 'Home')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <label for="search_query">Search:</label>
                    <input type="text" id="search_query" name="search" />
                </div>
                <p>
                    <button id="near_me" type="button" class="btn btn-default">Near Me!</button>
                </p>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {
            var route = '{{ route('pages::near', [':latitude', ':longitude']) }}';
            $('#near_me').on('click', function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var location = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        window.location.href = route.replace(':latitude', location.lat).replace(':longitude', location.lng);
                    }, function() {
                        alert('We can\'t access your location :(');
                    });
                } else {

                }
            })
        });
    </script>
@stop