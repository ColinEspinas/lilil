<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use SoftDeletes;

    public static function boot() {
        parent::boot();

        static::deleting(function($like) {
            $like->allActivities()->delete();
        });

        static::restored(function($like) {
            $like->allActivities()->restore();
        });

        static::created(function($like) {
            app('ActivityService')->like($like->id);
        });
    }

    protected $fillable = [
        'user_id',
        'message_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function message() {
        return $this->belongsTo(Message::class);
    }

    public function allActivities(){
        return $this->morphMany(Activity::class, 'activity');
    }

    public function activities() {
        return $this->morphMany(Activity::class, 'activity')->whereDeletedAt(null);
    }
}
