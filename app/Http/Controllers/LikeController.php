<?php

namespace App\Http\Controllers;

use App\Like;
use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function index() {
        $messages = Auth::User()->getLikedMessages();
        $messages->each(function($message) {
            $message['relative_time'] = Carbon::parse($message->created_at)->diffForHumans(Carbon::now());
        });

        $pageName = "Likes";
        return view('home', compact('pageName', 'messages'));
    }

    public function likeHandle($id) {
        $existingLike = Like::withTrashed()->whereMessageId($id)->whereUserId(Auth::id())->first();

        if (is_null($existingLike)) {
            Like::create([
                'user_id' => Auth::id(),
                'message_id' => $id
            ]);
        } else {
            if (is_null($existingLike->deleted_at)) {
                $existingLike->delete();
            } else {
                $existingLike->restore();
            }
        }
    }
}
