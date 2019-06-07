<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Follow
 * @package App
 */
class Follow extends Model
{
    use SoftDeletes;

    /**
     *
     */
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

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'followed_id'
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
    public function followed() {
        return $this->belongsTo(User::class, "followed_id");
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
