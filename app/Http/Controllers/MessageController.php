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
        $pageName = "Home";
        return view('home', compact('pageName', 'messages'));
    }

    public function update(Message $message) {
        $this->authorize('update', $message);
        $message->update(request('content'));
        $pageName = "Home";
        return back();
    }

    public function destroy(Message $message) {
        $this->authorize('delete', $message);
        $message->delete();
        return back();
    }
}
