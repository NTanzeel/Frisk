<div class="modal fade" id="createLocationModal" tabindex="-1" role="dialog" aria-labelledby="createLocationModal-title">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="createLocationModal-title">New Address</h4>
            </div>
            <form id="newLocationForm" action="{{ url('/dashboard/locations/create') }}" method="post">
                {!! csrf_field() !!}
                <div id="addressLookup">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="sr-only" for="search_postcode">Find Address Using Postcode</label>
                            <div class="input-group">
                                {{--<div class="input-group-addon">Postcode</div>--}}
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Postcode <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Postcode</a></li>
                                        <li><a href="#">Current Location</a></li>
                                    </ul>
                                </div>
                                <input type="text" class="form-control" id="search_postcode" placeholder="SW15 5EQ">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default">Find</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <div id="addressFields" class="hidden">
                    <div class="modal-body">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="reset" class="btn btn-info">Search Again</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>