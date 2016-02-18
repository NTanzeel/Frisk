<?php

namespace App\Http\Controllers;

use App\Http\Requests\Locations\CreateLocationRequest;
use App\Models\Location;
use Illuminate\Http\Request;

use App\Http\Requests;

class LocationsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $locations = \Auth::user()->locations;

        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateLocationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLocationRequest $request) {
        $location = new Location($request->all());

        \Auth::user()->locations()->save($location);

        return $request->ajax() ? $location->toJson() : redirect(url('/dashboard/locations'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $location = Location::find($id);

        return $location->items()->count();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $location = Location::find($id);

        $deleted = $location->items()->count() == 0 && $location->delete();

        return \Response::json([
            'success' => $deleted,
            'message' => $deleted ? 'The location has been deleted.' : 'Unable to delete location as one or more items are currently using it.'
        ], $deleted ? 200 : 400);
    }
}
