<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'activity_id',
        'activity_type',
    ];

    public function activity()
    {
        return $this->morphTo();
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
