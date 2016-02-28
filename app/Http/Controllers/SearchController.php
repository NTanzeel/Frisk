<?php

namespace App\Http\Controllers;

use DB;
use App\Models\StolenItem;
use Illuminate\Http\Request;

use App\Http\Requests;

class SearchController extends Controller {

    public function query(Request $request) {
        $query = StolenItem::with('item', 'location');
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
            ))->join('locations', 'stolen_items.location_id', '=', 'locations.id');
        }

        $query->whereHas('item', function ($builder) use ($request) {
            $builder->where('name', 'LIKE', '%' . $request->get('query') . '%');
            $builder->orWhere('identifier', 'LIKE', '%' . $request->get('query') . '%');
        });

        $results = $query->get();

        return view('pages.search', compact('results'));
    }


    public function near($latitude, $longitude) {
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
        ))->join('locations', 'stolen_items.location_id', '=', 'locations.id')->with([
            'item',
            'location',
            'item.user',
            'item.resources' => function($builder) {
                $builder->where('type', 'public');
            }
        ])->get();

        return view('pages.near', compact('results'));
    }

}
