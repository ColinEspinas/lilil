<?php

namespace App\Services;

use App\Activity;
use Illuminate\Support\Facades\Auth;

class ActivityService
{
    public function like($id) {
        $this->store('App\Like', $id);
        return back();
    }

    public function share($id) {
        $this->store('App\Share', $id);
        return back();
    }

    public function post($id) {
        $this->store('App\Message', $id);
        return back();
    }

    public function follow($id) {
        $this->store('App\Follow', $id);
        return back();
    }

    public function store($type, $id) {
        $existing_activity = Activity::withTrashed()->whereActivityType($type)->whereActivityId($id)->whereUserId(Auth::id())->first();

        if (is_null($existing_activity)) {
            Activity::create([
                'user_id'       => Auth::id(),
                'activity_id'   => $id,
                'activity_type' => $type,
            ]);
        } else {
            if (is_null($existing_activity->deleted_at)) {
                $existing_activity->delete();
            } else {
                $existing_activity->restore();
            }
        }
    }
}