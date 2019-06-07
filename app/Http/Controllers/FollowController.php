<?php

namespace App\Http\Controllers;

use App\User;
use App\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class FollowController
 * @package App\Http\Controllers
 */
class FollowController extends Controller
{
    /**
     * FollowController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display Followed users
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $pageName = "My Follows";
        return view('follows', compact('pageName'));
    }

    /**
     * Add/Restore/Delete follows from storage
     * 
     * @param int $id
     */
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

    /**
     * Add/Restore follows from storage
     * 
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Delete follows from storage
     * 
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unfollow($id) {
        $existingFollow = Follow::withTrashed()->whereFollowedId($id)->whereUserId(Auth::id())->first();
        if (is_null($existingFollow->deleted_at)) {
           $existingFollow->delete();
        }

        return back();
    }
}
