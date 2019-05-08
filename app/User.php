<?php

namespace App;

use App\Message;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'pseudo', 'bio'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * Get the user messages.
     */
    public function messages() {
        return $this->hasMany(Message::class, "author_id")->orderBy('created_at', 'desc');
    }

    public function likes() {
        return $this->hasMany(Like::class)->whereDeletedAt(null);
    }

    public function shares(){
        return $this->hasMany(Share::class)->whereDeletedAt(null);
    }

    public function follows() {
        return $this->hasMany(Follow::class)->whereDeletedAt(null)->orderBy('created_at', 'desc');
    }

    public function followers() {
        return $this->hasMany(Follow::class, "followed_id")->whereDeletedAt(null)->orderBy('created_at', 'desc');
    }

    public function getMessageLikesCount() {
        $likeCount = 0;
        foreach($this->messages as $message) {
            $likeCount += count($message->likes);
        }
        return $likeCount;
    }

    public function getLikedMessages() {
        $messages_id = array();
        foreach($this->likes->toArray() as $like) {
            $messages_id[] = $like["message_id"];
        };
        return Message::whereIn('id', $messages_id)->orderBy('created_at', 'desc')->get();
    }
    public function getSharedMessages() {
        $messages_id = array();
        foreach($this->shares->toArray() as $share) {
            $messages_id[] = $share["message_id"];
        };
        return Message::whereIn('id', $messages_id)->orderBy('created_at', 'desc')->get();
    }
    public function getMessageSharesCount() {
        $shareCount = 0;
        foreach($this->messages as $message) {
            $shareCount += count($message->shares);
        }
        return $shareCount;
    }
    public function getRegisterDate() {
        return Carbon::parse($this->create_at)->isoFormat('MM/DD/YY');
    }

    public function getRegisterDateFromNow() {
        return Carbon::parse($this->created_at)->diffForHumans(Carbon::now());
    }
}
