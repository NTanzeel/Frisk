<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use App\Models\Item;

class PagesController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('pages.index');
    }

    public function search($query) {
        $items = Item::select(DB::raw(
            'items.*,
            ROUND(
                ACOS(
                    SIN(latitude * PI() / 180) *
                    SIN(52.381698892592546 * PI() / 180) +
                    COS(latitude * PI() / 180) *
                    COS(52.381698892592546 * PI() / 180) *
                    COS((-1.5618722483682541) * PI() / 180 - longitude * PI() / 180)
                ) * 6371,
            0) AS distance'
        ))
            ->join('stolenitems', 'items.id', '=', 'stolenitems.item_id')
            ->join('locations', 'stolenitems.location_id', '=', 'locations.id')
            ->where('name', 'LIKE', '%' . $query . '%')
            ->orderBy('distance', 'ASC')
            ->get();

        return view('pages.search', compact('items'));
    }


    public function near($latitude, $longitude) {
        $items = Item::select(DB::raw(
            'items.*,
            ROUND(
                ACOS(
                    SIN(latitude * PI() / 180) *
                    SIN(? * PI() / 180) +
                    COS(latitude * PI() / 180) *
                    COS(? * PI() / 180) *
                    COS(? * PI() / 180 - longitude * PI() / 180)
                ) * 6371,
            0) AS distance'
        ))
            ->join('stolenitems', 'items.id', '=', 'stolenitems.item_id')
            ->join('locations', 'stolenitems.location_id', '=', 'locations.id')
            ->setBindings([':s_latitude' => $latitude, ':c_latitude' => $latitude, ':longitude' => $longitude])
            ->orderBy('distance', 'ASC')
            ->having('distance', '<=', '20')
            ->get();

        return view('pages.search', compact('items'));
    }
}
