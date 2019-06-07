<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
class SearchController extends Controller
{
    /**
     * Display search page
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $search = request('search');
        $users = User::where('name','like',"%{$search}%")->orWhere('pseudo','like',"%{$search}%")->get();
        $messages=collect();
        if($search!=''){
            $messages = Message::where('content','like',"%{$search}%")->get();
        }
        $pageName = 'Search';
        return view('search',compact('users', 'search','messages', 'pageName'));
    }
}
