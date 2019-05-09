<?php

namespace App\Http\Controllers;

use App\Like;
use App\Share;
use App\Follow;
use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store() 
    {
        request()->validate([
            "content" => ["required","max:140"]
        ]);

        Message::create([
            "content" => request('content'),
            "author_id" => Auth::id()
        ]);
        return redirect("/");
    }

    public function index() 
    {
    }

    public function update(Message $message) 
    {
        $this->authorize('update', $message);

        request()->validate([
            "updated-content" => ["required","max:140"]
        ]);

        $message->update([
            'content' => request('updated-content')
        ]);

        return back();
    }

    public function destroy(Message $message)
    {
        $this->authorize('delete', $message);
        $message->delete();
        return back();
    }
}
