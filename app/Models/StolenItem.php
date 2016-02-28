<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StolenItem extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id', 'location_id',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function item() {
        return $this->belongsTo('\App\Models\Item');
    }

    public function location() {
        return $this->belongsTo('\App\Models\Location');
    }
}
