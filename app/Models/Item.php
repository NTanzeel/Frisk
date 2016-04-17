<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed id
 * @property mixed user_id
 * @property mixed name
 * @property mixed resources
 */
class Item extends Model {

    use SoftDeletes;

    protected $fillable = [
        'location_id', 'name', 'identifier', 'value', 'description'
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected static function boot() {
        parent::boot();

        self::deleted(function(Item $item) {
            $item->resources()->delete();
            $item->stolenRecord()->delete();
        });
    }

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

    public function groupedResources() {
        return collect(['public' => [], 'private' => [], 'all' => $this->resources])->merge($this->resources->groupBy(function ($resource) {
            return $resource->type == Resource::$PUBLIC ? 'public' : 'private';
        }));
    }
}
