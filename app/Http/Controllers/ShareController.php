<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Share;
use Illuminate\Support\Facades\Auth;

class ShareController extends Controller
{
    public function index() {
        $messages = Auth::User()->getSharedMessages();
        $pageName = "Share";
        return view('shares', compact('pageName', 'messages'));
    }

    public function shareHandle($id) {
        $existingShare = Share::withTrashed()->whereMessageId($id)->whereUserId(Auth::id())->first();

        if (is_null($existingShare)) {
            Share::create([
                'user_id' => Auth::id(),
                'message_id' => $id
            ]);
        } else {
            if (is_null($existingShare->deleted_at)) {
                $existingShare->delete();
            } else {
                $existingShare->restore();
            }
        }
    }
}
