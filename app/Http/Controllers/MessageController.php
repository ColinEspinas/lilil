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
        $followsMessages = collect();
        $followsLikedMessages = collect();
        $followsSharedMessages = collect();

        foreach (Auth::User()->follows as $follow) {
            foreach ($follow->followed->messages as $message) {
                $followsMessages->push($message);
            }
            foreach ($follow->followed->getSharedMessages() as $message) {
                $followsSharedMessages->push($message);
            }
            foreach ($follow->followed->getLikedMessages() as $message) {
                $followsLikedMessages->push($message);
            }
        }
        $messages = Auth::User()->messages->merge($followsMessages)->merge($followsLikedMessages)->merge($followsSharedMessages)->sortByDesc('created_at');
        $pageName = "Home";
        return view('home', compact('pageName', 'messages'));
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
