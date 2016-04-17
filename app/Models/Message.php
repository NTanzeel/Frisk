<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed id
 */
class Message extends Model {

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stolen_item_id', 'sender_id', 'recipient_id', 'content', 'seen_at'
    ];

    protected $dates = [
        'seen_at', 'deleted_at'
    ];

    public function sender() {
        return $this->belongsTo('\App\Models\User', 'sender_id')->withTrashed();
    }

    public function recipient() {
        return $this->belongsTo('\App\Models\User', 'recipient_id')->withTrashed();
    }

    public function regarding() {
        return $this->belongsTo('\App\Models\StolenItem', 'stolen_item_id')->withTrashed();
    }

    public function deletionRecord() {
        return $this->hasOne('\App\Models\DeletedMessage');
    }
}
