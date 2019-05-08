<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Follow extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'followed_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function followed() {
        return $this->belongsTo(User::class, "followed_id");
    }
}
