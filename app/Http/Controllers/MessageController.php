<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use Carbon\Carbon;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store() {
        Message::create([
            "content" => request('content'),
            "author_id" => Auth::id()
        ]);
        return redirect("/");
    }

    public function index() {
        $messages = Auth::User()->messages;
        $messages->each(function($message) {
            $message['relative_time'] = Carbon::parse($message->created_at)->diffForHumans(Carbon::now());
        });

        $pageName = "Home";
        return view('home', compact('pageName', 'messages'));
    }
}
