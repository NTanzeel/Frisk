<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property mixed id
 * @property mixed email
 */
class User extends Authenticatable
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function storagePath() {
        return md5($this->id . $this->email);
    }

    public function oAuth() {
        return $this->hasMany('\App\Models\OAuth');
    }

    public function locations() {
        return $this->hasMany('\App\Models\Location');
    }

    public function items() {
        return $this->hasMany('\App\Models\Item');
    }
}
