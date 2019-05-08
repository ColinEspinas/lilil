<?php

namespace App\Http\Controllers;

use App\User;
use App\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function index() {
        $pageName = "My Follows";
        return view('follows', compact('pageName'));
    }

    public function FollowHandle($id) {
        $existingFollow = Follow::withTrashed()->whereFollowedId($id)->whereUserId(Auth::id())->first();

        if (is_null($existingFollow)) {
            Follow::create([
                'user_id' => Auth::id(),
                'followed_id' => $id
            ]);
        } else {
            if (is_null($existingFollow->deleted_at)) {
                $existingFollow->delete();
            } else {
                $existingFollow->restore();
            }
        }
    }

    public function follow($id) {
        $existingFollow = Follow::withTrashed()->whereFollowedId($id)->whereUserId(Auth::id())->first();
        if (is_null($existingFollow)) {
            Follow::create([
                'user_id' => Auth::id(),
                'followed_id' => $id
            ]);
        } else {
            if (!is_null($existingFollow->deleted_at)) {
            $existingFollow->restore();
            }
        }

        return back();
    }

    public function unfollow($id) {
        $existingFollow = Follow::withTrashed()->whereFollowedId($id)->whereUserId(Auth::id())->first();
        if (is_null($existingFollow->deleted_at)) {
           $existingFollow->delete();
        }

        return back();
    }
}
