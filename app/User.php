<?php

namespace App;

use App\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     *
     */
    public static function boot() {
        parent::boot();

        static::deleting(function($user) {
            if (Storage::exists("/avatars/" . $user->avatar) && $user->avatar !== "user.png")
                Storage::delete("/avatars/" . $user->avatar);
            if (Storage::exists("/banners/" . $user->banner) && $user->banner !== "user.png")
                Storage::delete("/banners/" . $user->banner);
            foreach ($user->messages as $message) {
                $message->delete();
            }
            foreach ($user->allActivities as $activity) {
                $activity->delete();
            }
            foreach ($user->allFollows as $follow) {
                $follow->delete();
            }
            foreach ($user->AllFollowers as $follower) {
                $follower->delete();
            }
            foreach ($user->allLikes as $like) {
                $like->delete();
            }
            foreach ($user->allShares as $share) {
                $share->delete();
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'pseudo', 'bio', 'avatar', 'banner'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
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
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages() {
        return $this->hasMany(Message::class, "author_id")->orderBy('created_at', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes() {
        return $this->hasMany(Like::class)->whereDeletedAt(null);
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
    public function shares(){
        return $this->hasMany(Share::class)->whereDeletedAt(null);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function allShares(){
        return $this->hasMany(Share::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function follows() {
        return $this->hasMany(Follow::class)->whereDeletedAt(null)->orderBy('created_at', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function allFollows() {
        return $this->hasMany(Follow::class)->orderBy('created_at', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function followers() {
        return $this->hasMany(Follow::class, "followed_id")->whereDeletedAt(null)->orderBy('created_at', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function AllFollowers() {
        return $this->hasMany(Follow::class, "followed_id")->orderBy('created_at', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activities() {
        return $this->hasMany(Activity::class)->whereDeletedAt(null)->orderBy('created_at', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function allActivities() {
        return $this->hasMany(Activity::class)->orderBy('created_at', 'desc');
    }

    /**
     * @return int
     */
    public function getMessageLikesCount() {
        $likeCount = 0;
        foreach($this->messages as $message) {
            $likeCount += count($message->likes);
        }
        return $likeCount;
    }

    /**
     * @return mixed
     */
    public function getLikedMessages() {
        $messages_id = array();
        foreach($this->likes->toArray() as $like) {
            $messages_id[] = $like["message_id"];
        };
        return Message::whereIn('id', $messages_id)->orderBy('created_at', 'desc')->get();
    }

    /**
     * @return mixed
     */
    public function getSharedMessages() {
        $messages_id = array();
        foreach($this->shares->toArray() as $share) {
            $messages_id[] = $share["message_id"];
        };
        return Message::whereIn('id', $messages_id)->orderBy('created_at', 'desc')->get();
    }

    /**
     * @return int
     */
    public function getMessageSharesCount() {
        $shareCount = 0;
        foreach($this->messages as $message) {
            $shareCount += count($message->shares);
        }
        return $shareCount;
    }

    /**
     * @return string
     */
    public function getRegisterDate() {
        return Carbon::parse($this->created_at)->isoFormat('MM/DD/YY');
    }

    /**
     * @return string
     */
    public function getRegisterDateFromNow() {
        return Carbon::parse($this->created_at)->diffForHumans(Carbon::now());
    }
}
