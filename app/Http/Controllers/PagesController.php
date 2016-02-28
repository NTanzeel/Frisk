<?php

namespace App\Http\Controllers;

use DB;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\StolenItem;

class PagesController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('pages.index');
    }
}
