<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'location_id', 'name', 'identifier', 'description'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function owner() {
        return $this->belongsTo('\App\Models\User');
    }

    public function location() {
        return $this->hasOne('\App\Models\Location');
    }
}
