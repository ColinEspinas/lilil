<?php

namespace App\Http\Controllers;

use App\Like;
use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        $messages = Auth::User()->getLikedMessages();
        $pageName = "Likes";
        return view('likes', compact('pageName', 'messages'));
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
