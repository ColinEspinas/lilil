<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Follow extends Model
{
    use SoftDeletes;

    public static function boot() {
        parent::boot();

        static::deleting(function($follow) {
            $follow->allActivities()->forceDelete();
        });

        static::restored(function($follow) {
            $follow->allActivities()->restore();
        });

        static::created(function($follow) {
            app('ActivityService')->follow($follow->id);
        });
    }

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

    public function allActivities(){
        return $this->morphMany(Activity::class, 'activity');
    }

    public function activities() {
        return $this->morphMany(Activity::class, 'activity')->whereDeletedAt(null);
    }
}
