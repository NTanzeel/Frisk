<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ItemsController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $items = Auth::user()->items()->with(['location', 'resources' => function($query) {
            return $query->where('type', 'coverImage')->get();
        }])->get();

        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $locations = [null => 'Please Select'];
        foreach (Auth::user()->locations as $location) {
            $locations[$location->id] = $location->first_address_line . ', ' . $location->postcode;
        }
        return view('items.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\CreateItemRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateItemRequest $request) {

        $item = new Item([
            'location_id' => $request->get('location'),
            'name' => $request->get('name'),
            'identifier' => $request->get('identifier'),
            'description' => $request->get('description'),
        ]);

        Auth::user()->items()->save($item);

        $coverImage = $request->file('coverImage');

        if ($coverImage && $coverImage->isValid()) {
            $fileName = $coverImage->getFilename() . '.' . $coverImage->getClientOriginalExtension();
            $storagePath = 'uploads/' . Auth::user()->storagePath() . '/' . $item->storagePath();
            $coverImage->move($storagePath, $fileName);

            $item->resources()->save(new Resource([
                'name' => $fileName,
                'path' => $storagePath,
                'type' => 'image'
            ]));
        }

        return redirect(route('items::index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
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
        //
    }
}
