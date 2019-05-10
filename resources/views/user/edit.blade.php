@extends('layouts.app')

@section('content')
<h1 class="background-title">{{ $pageName }}</h1>
<div style="padding-bottom: 100px;"></div>
<div class="lil-row center padding-tb-15">
    <div class="lil-col sm-10-12 md-8-12 lg-6-12 xl-4-12">
        <h2 class="section-title"><i data-feather="settings"></i>Settings</h2>
        <form class="settings-form" method="POST" action="/users/{{$user->name}}">
            @method('PATCH')
            @csrf
            <input class="block width-100 margin-tb-15" type="text" name="pseudo" placeholder="Enter a pseudo."
                value="{{$user->pseudo}}" required>
            <textarea class="block width-100 margin-tb-15" name="bio"
                placeholder="Enter a bio to describe who you are.">{{$user->bio}}</textarea>
            <input type="password" name="password" placeholder="Enter new password" class="margin-tb-15 width-100 center"
                autocomplete="new-password">
            @error('password')
            <span class="right error-message" role="alert">{{ $message }}</span>
            @enderror
            <input type="password" name="password_confirmation" placeholder="Confirm password"
                class="margin-tb-15 width-100 center" autocomplete="new-password">
            <button type="submit" class="btn margin-tb-15 right"><i data-feather="refresh-cw"></i>Update profil</button>
            <div class="lil-clear"></div>
    </div>
    </form>
</div>
</div>
@endsection
