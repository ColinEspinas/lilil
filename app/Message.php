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

    public function author() {
        return $this->belongsTo(User::class, "author_id");
    }

    public function likes() {
        return $this->hasMany(Like::class)->whereDeletedAt(null);
    }

    public function hasUserLiked() {
        $like = $this->likes()->whereUserId(Auth::id())->first();
        return (!is_null($like)) ? true : false;
    }

    public function getRelativeTime() {
        return Carbon::parse($this->created_at)->diffForHumans(Carbon::now());
    }
}
