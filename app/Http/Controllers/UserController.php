<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\DocBlock\Tags\Author;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
        $activities = collect();
        foreach($user->activities as $activity) {
            if ($activity->activity_type == "App\Message"
             || $activity->activity_type == "App\Share") {
                $activities->push($activity);
            }
        }

        $pageName = $user->pseudo . " (@" . $user->name . ")";
        return view('user.index', compact('pageName', 'user', 'activities'));
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
        $data = array();

        if (request('password') !== null) {
            request()->validate([
                'password' => ['string', 'min:8', 'confirmed']
            ]);
            $data['password'] = Hash::make(request('password'));
        }

        request()->validate([
            'pseudo'=>['required','string', 'max:64'],
            'bio'=>['max:140'],
        ]);

        $data['pseudo'] = request('pseudo');
        $data['bio'] = request('bio');

        $user->update($data);

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
