<?php

namespace App\Http\Controllers;

use App\Models\Resource;

use App\Http\Requests;
use App\Http\Requests\Items\CreateItemRequest;
use App\Http\Requests\Items\UpdateItemRequest;

use App\Models\Item;
use App\Models\StolenItem;
use Illuminate\Http\Request;
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
        $items = Auth::user()->items()->with(['location', 'stolenRecord', 'resources' => function($builder) {
            $builder->where('type', 'public');
        }])->paginate(15);

        $private = [];
        $stolen = [];

        foreach ($items as $item) {
            if ($item->stolenRecord) {
                $stolen[] = $item;
            } else {
                $private[] = $item;
            }
        }

        return view('items.index', compact('items', 'private', 'stolen'));
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
     * @param CreateItemRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateItemRequest $request) {
        $item = new Item([
            'location_id'   => $request->get('location'),
            'name'          => $request->get('name'),
            'identifier'    => $request->get('identifier'),
            'description'   => $request->get('description'),
            'value'         => $request->get('value')
        ]);

        Auth::user()->items()->save($item);

        $coverImage = $request->file('public');

        if ($coverImage && $coverImage->isValid()) {
            $fileName = $coverImage->getFilename() . '.' . $coverImage->getClientOriginalExtension();
            $storagePath = 'uploads/' . Auth::user()->storagePath() . '/' . $item->storagePath();
            $coverImage->move($storagePath, $fileName);

            $item->resources()->save(new Resource([
                'name' => $fileName,
                'path' => $storagePath,
                'type' => 'public'
            ]));
        }

        return redirect()->route('items::index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $item = Item::with('stolenRecord', 'resources')->where('id', $id)->first();

        if ($item && $item->user_id == Auth::user()->id) {

            $locations = [null => 'Please Select'];
            foreach (Auth::user()->locations as $location) {
                $locations[$location->id] = $location->first_address_line . ', ' . $location->postcode;
            }

            return view('items.edit', compact('item', 'locations'));
        } else {
            return redirect()->route('items::index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateItemRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, $id) {
        $item = Item::find($id);

        $success = $item && $item->user_id == Auth::user()->id;

        if ($success) {
            $success = $item->update([
                'location_id'   => $request->get('location'),
                'name'          => $request->get('name'),
                'identifier'    => $request->get('identifier'),
                'description'   => $request->get('description'),
                'value'         => $request->get('value')
            ]);
        }

        $response = [
            'success' => $success,
            'message' => $success ? 'The changes have been saved.' : 'There was an error whilst saving your changes.'
        ];

        if($request->ajax()) {
            return response()->json($response, $response['success'] ? 200 : 400);
        } else {
            return response()->redirectToRoute('items::edit', $id)->with('response', $response);
        }
    }

    public function toggleStolen(Request $request, $id) {
        $item = Item::find($id);

        $success = $item && $item->user_id == Auth::user()->id;

        if ($success) {
            if ($item->stolenRecord) {
                $item->stolenRecord()->delete();
            } else {
                StolenItem::create([
                    'item_id'       => $id,
                    'location_id'   => $request->get('location')
                ])->save();
            }

            return redirect()->route('items::edit', $id);
        } else {
            return redirect()->route('items::index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $item = Item::find($id);

        $deleted = $item && $item->user_id == Auth::user()->id && $item->delete();

        return \Response::json([
            'success' => $deleted,
            'message' => $deleted ? 'The item has been deleted.' : 'Unable to delete the item.'
        ], $deleted ? 200 : 400);
    }
}
