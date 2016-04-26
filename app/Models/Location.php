<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'longitude', 'latitude', 'first_address_line', 'second_address_line', 'city', 'region', 'postcode'
    ];

    protected $attributes = [
        'default' => 0
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function user() {
        return $this->belongsTo('\App\Models\User');
    }

    public function items() {
        return $this->hasMany('\App\Models\Item');
    }

    public function stolenRecords() {
        return $this->hasMany('\App\Models\StolenItem');
    }
}
