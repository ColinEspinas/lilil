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
        // Only auth users can see shlikes & like content
        $this->middleware('auth');
    }

    /**
     * Display auth user liked messages
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $messages = Auth::User()->getLikedMessages();
        $pageName = "Likes";
        return view('likes', compact('pageName', 'messages'));
    }

    /**
     * Add/Restore/Delete likes from storage
     *
     * @param  int  $id
     */
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
