<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeletedMessage extends Model {

    use SoftDeletes;

    protected $fillable = [
        'messaged_id', 'deleted_by'
    ];

    protected $dates = [
        'deleted_at'
    ];
}
