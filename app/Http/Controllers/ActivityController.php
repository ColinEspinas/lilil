<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class ActivityController
 * @package App\Http\Controllers
 */
class ActivityController extends Controller
{
    /**
     * ActivityController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $userActivities = collect();
        $followsActivities = collect();

        foreach (Auth::User()->activities as $activity) {
            if ($activity->activity_type == "App\Message") {
                $userActivities->push($activity);
            }
        }

        foreach (Auth::User()->follows as $follow) {
            $followsActivities = $followsActivities->merge($follow->followed->activities);
        }

        $activities = $userActivities->merge($followsActivities)->sortByDesc('created_at');

        $pageName = "Home";
        return view('home', compact('pageName', 'activities'));
    }
}
