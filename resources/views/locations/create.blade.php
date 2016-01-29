@extends('layouts.dashboard.index')

@section('title', 'New Location')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Locations</div>
        <div class="panel-body">
            <form id="newLocationForm" action="{{ url('/dashboard/locations/create') }}" method="post">
                {!! csrf_field() !!}
                <div id="addressLookup">
                    <div class="form-group">
                        <label class="sr-only" for="search_postcode">Find Address Using Postcode</label>
                        <div class="input-group">
                            <div class="input-group-addon">Postcode</div>
                            <input type="text" class="form-control" id="search_postcode" placeholder="SW15 5EQ">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">Find</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div id="addressFields" class="hidden">
                    <div class="form-group">
                        <label for="door_no">Door No</label>
                        <input type="text" class="form-control" id="door_no" name="door_no" placeholder="6" aria-required="true">
                    </div>
                    <div class="form-group">
                        <label for="first_address_line">Street Address</label>
                        <input type="text" class="form-control" id="first_address_line" name="first_address_line" placeholder="University Road" aria-required="true">
                    </div>
                    <div class="form-group">
                        <label for="second_address_line">Street Address</label>
                        <input type="text" class="form-control" id="second_address_line" name="second_address_line" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Coventry" aria-required="true">
                    </div>
                    <div class="form-group">
                        <label for="region">Region</label>
                        <input type="text" class="form-control" id="region" name="region" placeholder="West Midlands" aria-required="true">
                    </div>
                    <div class="form-group">
                        <label for="postcode">Postcode</label>
                        <input type="tel" class="form-control" id="postcode" name="postcode" placeholder="CV4 7EZ" aria-required="true" readonly>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="reset" class="btn btn-info">Search Again</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('scripts')
    @parent
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASGCfgteFuvjCkXtXq9lTWgtCRW0qrcsw"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/dashboard/AddressLookup.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
           $('#newLocationForm').AddressLookup({
               'fillForm' : function(fields, address) {
                   fields.find('#first_address_line').val(address.route);
                   fields.find('#city').val(address.postal_town);
                   fields.find('#region').val(address.administrative_area_level_2);
                   fields.find('#postcode').val(address.postal_code);
               }
           });
        });
    </script>
@stop