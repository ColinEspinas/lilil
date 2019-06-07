<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Share
 * @package App
 */
class Share extends Model
{
    use SoftDeletes;

    /**
     *
     */
    public static function boot() {
        parent::boot();

        static::deleting(function($share) {
            $share->allActivities()->forceDelete();
        });

        static::restored(function($share) {
            $share->allActivities()->restore();
        });

        static::created(function($share) {
            app('ActivityService')->share($share->id);
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
