<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Like
 * @package App
 */
class Like extends Model
{
    use SoftDeletes;

    /**
     *
     */
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

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'message_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function message() {
        return $this->belongsTo(Message::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function allActivities(){
        return $this->morphMany(Activity::class, 'activity');
    }

    /**
     * @return mixed
     */
    public function activities() {
        return $this->morphMany(Activity::class, 'activity')->whereDeletedAt(null);
    }
}
