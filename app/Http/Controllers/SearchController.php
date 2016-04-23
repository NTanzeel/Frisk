<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Resource;
use App\Models\StolenItem;
use Illuminate\Http\Request;

use App\Http\Requests;

class SearchController extends Controller {

    public function index(Request $request) {
        $query = StolenItem::with('item', 'location')->whereHas('item', function ($builder) use ($request) {
            $builder->whereNested(function($builder) use($request) {
                $builder->where('name', 'LIKE', '%' . $request->get('query') . '%');
                $builder->orWhere('identifier', 'LIKE', '%' . $request->get('query') . '%');
            });
        });

        if($request->has('latitude') && $request->has('longitude')) {
            $query = $query->select(DB::raw(
                'stolen_items.*, ROUND(
                    ACOS(
                        SIN(latitude * PI() / 180) *
                        SIN('. $request->get('latitude') .' * PI() / 180) +
                        COS(latitude * PI() / 180) *
                        COS(' . $request->get('latitude') . ' * PI() / 180) *
                        COS(' . $request->get('longitude') . ' * PI() / 180 - longitude * PI() / 180)
                    ) * 6371,
                0) AS distance'
            ))->join('locations', 'stolen_items.location_id', '=', 'locations.id')->orderBy('distance', 'ASC');
        }

        $results = $query->get();

        return view('search.search', compact('results'));
    }


    public function near(Request $request, $latitude, $longitude) {
        $validOrdering = ['name', 'distance'];
        $validSorting = ['ASC', 'DESC'];

        $order = $request->has('order') && in_array($request->get('order'), $validOrdering) ? $request->get('order') : 'distance';
        $sort = $request->has('sort') && in_array($request->get('sort'), $validSorting) ? $request->get('sort') : 'ASC';

        $results = StolenItem::select(DB::raw(
            'stolen_items.*, ROUND(
                ACOS(
                    SIN(latitude * PI() / 180) *
                    SIN('. $latitude .' * PI() / 180) +
                    COS(latitude * PI() / 180) *
                    COS(' . $latitude . ' * PI() / 180) *
                    COS(' . $longitude . ' * PI() / 180 - longitude * PI() / 180)
                ) * 6371,
            0) AS distance'
        ))->join('locations', 'stolen_items.location_id', '=', 'locations.id')->join('items', 'stolen_items.item_id', '=', 'items.id')->with([
            'item',
            'location',
            'item.user',
            'item.resources' => function($builder) {
                $builder->where('type', Resource::$PUBLIC);
            }
        ])->having('distance', '<=', 20)->orderBy($order, $sort)->get();

        $markers = [];

        foreach($results as $result) {
            $markers[] = ['lat' => $result->location->latitude, 'lng' => $result->location->longitude];
        }

        return view('search.near', compact('results', 'markers', 'order', 'sort', 'latitude', 'longitude'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $request = StolenItem::with('item', 'location', 'item.user', 'item.resources')->where('id', $id)->first();

        return $request;
    }
}
