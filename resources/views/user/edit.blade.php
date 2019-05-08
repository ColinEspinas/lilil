{{-- @extends('layouts.app')

@section('content')

<h1> je suis sur edit user de {{$user->name}} </h1>

<div class="lil-row center padding-tb-15">
    <div class="lil-col md-10-12 lg-8-12 xl-3-12">
        <h2>Voila la bio de {{$user->name}} </h2>
        <form method="POST" action="/users/{{$user->name}}">
            @method('PATCH')
            @csrf
                <input name="pseudo" value="{{$user->pseudo}}">
                <textarea class="textarea" name="bio">{{$user->bio}}</textarea>
                <button type="submit" class="button is-link">Update profil</button>
            </div>
        </form>
    </div>
</div>
@endsection --}}

@extends('layouts.app')

@section('content')
    <h1 class="background-title">{{ $pageName }}</h1>
    <div style="padding-bottom: 100px;"></div>
    <div class="lil-row center padding-tb-15">
        <div class="lil-col sm-10-12 md-8-12 lg-6-12 xl-4-12">
            <h2>Settings</h2>
            <form class="settings-form" method="POST" action="/users/{{$user->name}}">
                @method('PATCH')
                @csrf
                    <input class="block width-100 margin-tb-15" type="text" name="pseudo" value="{{$user->pseudo}}" required>
                    <textarea class="block width-100 margin-tb-15" name="bio">{{$user->bio}}</textarea>
                    <button type="submit" class="btn margin-tb-15 right"><i data-feather="refresh-cw"></i>Update profil</button>
                    <div class="lil-clear"></div>
                </div>
            </form>
        </div>
    </div>
@endsection
