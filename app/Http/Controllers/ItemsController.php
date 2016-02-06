<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ItemsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Auth::user()->items;

        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = [null => 'Please Select'];
        foreach(Auth::user()->locations as $location) {
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
    public function store(Requests\CreateItemRequest $request)
    {
        Auth::user()->items()->save(new Item(array_merge(['location_id' => $request->get('location')], $request->all())));

        return redirect(route('items::index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
