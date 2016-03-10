<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property Item   item
 * @property mixed  item_id
 * @property mixed path
 * @property mixed name
 */
class Resource extends Model {
    use SoftDeletes;

    public static $PUBLIC = 1;
    public static $PRIVATE = 2;
    public static $OTHER = 3;

    protected $fillable = [
        'alias', 'name', 'path', 'type'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function item() {
        return $this->belongsTo('\App\Models\Item');
    }

    public function getPathAttribute($path) {
        return asset($path);
    }
}
