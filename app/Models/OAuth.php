<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OAuth extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'auth_id', 'provider'
    ];

    public function user() {
        return $this->belongsTo('\App\Models\User');
    }
}
