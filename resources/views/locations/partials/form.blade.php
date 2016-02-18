<div class="modal fade" id="createLocationModal" tabindex="-1" role="dialog" aria-labelledby="createLocationModal-title">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="createLocationModal-title">New Address</h4>
            </div>
            <form id="newLocationForm" action="{{ route('locations::store') }}" method="post">
                {!! csrf_field() !!}
                <div id="addressLookup">
                    <div class="modal-body">
                        <div class="form-group margin-bottom-0">
                            <label for="search_postcode">Postcode</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="search_postcode" placeholder="E14 5AB" maxlength="8">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default">Find</button>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a id="use_current_location" href="#">Current Location</a></li>
                                    </ul>
                                </div>
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
                        <button type="reset" class="btn btn-info">Search Again</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>