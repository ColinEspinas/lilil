<?php

namespace App\Http\Controllers;

use App\Message;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class TendenciesController extends Controller
{

    /**
     * Display tendencies page with more trendy messages
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $messages = Message::where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString())->get();
        
        foreach ($messages as $message) {
            $message['trend_score'] = count($message->likes) + count($message->shares);
        }

        $messages=$messages->sortByDesc('trend_score')->take(10);

        $pageName = 'Tendencies';
        return view('tendencies',compact('messages', 'pageName'));
    }
}
