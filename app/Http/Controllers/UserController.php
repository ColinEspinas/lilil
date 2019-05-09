<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Author;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     *
     *
     */

    public function search(){
    $search = request('search');
    $users = User::where('name','like',"%{$search}%")->get();

    return view('searchShow',compact('users'));
    }
    public function __construct()
    {

    }

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $messages = $user->messages->merge($user->getSharedMessages());
        $pageName = $user->pseudo . " (@" . $user->name . ")";
        return view('user.index', compact('pageName', 'user', 'messages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('view',$user);
        $pageName = "Settings";
        return view('user.edit',compact('user', 'pageName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        request()->validate([
            'pseudo'=>['required','string', 'max:64'],
            'bio'=>['max:140']
        ]);

        $user->update([
            "pseudo" => request('pseudo'),
            "bio" => request('bio')
        ]);

        return redirect("/users/" . $user->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        
    }
}
