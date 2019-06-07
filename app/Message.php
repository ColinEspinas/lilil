<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Message
 * @package App
 */
class Message extends Model
{
    /**
     *
     */
    public static function boot() {
        parent::boot();

        static::deleting(function($message) {
            foreach ($message->allLikes as $like) {
                $like->allActivities()->forceDelete();
            }
            foreach ($message->allShares as $share) {
                $share->allActivities()->forceDelete();
            }
            $message->allActivities()->forceDelete();
            $message->allLikes()->forceDelete();
            $message->allShares()->forceDelete();
        });

        static::created(function($message) {
            app('ActivityService')->post($message->id);
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'author_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author() {
        return $this->belongsTo(User::class, "author_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function allLikes() {
        return $this->hasMany(Like::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function allShares(){
        return $this->hasMany(Share::class);
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
    public function likes() {
        return $this->hasMany(Like::class)->whereDeletedAt(null);
    }

    /**
     * @return mixed
     */
    public function  shares(){
        return $this->hasMany(Share::class)->whereDeletedAt(null);
    }

    /**
     * @return mixed
     */
    public function activities() {
        return $this->morphMany(Activity::class, 'activity')->whereDeletedAt(null);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getFollowsLikes() {
        $followsLikes = collect();
        foreach ($this->likes as $like) {
            foreach (Auth::User()->follows as $follow) {
                if ($like->user->id == $follow->followed->id) {
                    $followsLikes->push($follow->followed);
                }
            }
        }
        return $followsLikes;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getFollowsShares() {
        $followsShares = collect();
        foreach ($this->shares as $share) {
            foreach (Auth::User()->follows as $follow) {
                if ($share->user->id == $follow->followed->id) {
                    $followsShares->push($follow->followed);
                }
            }
        }
        return $followsShares;
    }

    /**
     * @return bool
     */
    public function hasUserLiked() {
        $like = $this->likes()->whereUserId(Auth::id())->first();
        return (!is_null($like)) ? true : false;
    }

    /**
     * @return bool
     */
    public function hasUserShared() {
        $share = $this->shares()->whereUserId(Auth::id())->first();
        return (!is_null($share)) ? true : false;
    }

    /**
     * @return string
     */
    public function getRelativeTime() {
        return Carbon::parse($this->created_at)->diffForHumans(Carbon::now());
    }
}
