<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;


class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'author_id'
    ];

    public static function boot() {
        parent::boot();

        static::deleting(function($message) {
            $message->allLikes()->forceDelete();
        });
    }

    public function author() {
        return $this->belongsTo(User::class, "author_id");
    }

    public function allLikes() {
        return $this->hasMany(Like::class);
    }

    public function likes() {
        return $this->hasMany(Like::class)->whereDeletedAt(null);
    }

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

    public function hasUserLiked() {
        $like = $this->likes()->whereUserId(Auth::id())->first();
        return (!is_null($like)) ? true : false;
    }

    public function getRelativeTime() {
        return Carbon::parse($this->created_at)->diffForHumans(Carbon::now());
    }
}
