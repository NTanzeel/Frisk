<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed name
 * @property mixed id
 * @property mixed user_id
 */
class Item extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'location_id', 'name', 'identifier', 'value', 'description'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function storagePath() {
        return md5($this->id . $this->name);
    }

    public function user() {
        return $this->belongsTo('\App\Models\User');
    }

    public function location() {
        return $this->belongsTo('\App\Models\Location');
    }

    public function resources() {
        return $this->hasMany('\App\Models\Resource');
    }

    public function stolenRecord() {
        return $this->hasOne('\App\Models\StolenItem');
    }
}
