
@extends('layouts.app')

@section('content')



<h1> je suis sur edit user de {{$user->name}} </h1>

<div class="lil-row center padding-tb-15">
    <div class="lil-col md-10-12 lg-8-12 xl-3-12">
<form method="POST" action="/users/{{$user->name}}">
{{method_field('PATCH')}}
{{csrf_field()}}

    <label>Voila la bio de {{$user->name}} </label>
    <div class="stat-list">
    <div>

        <textarea class="textarea" name="pseudo">{{$user->pseudo}}</textarea>

    </div>
    <div class="control">

        <textarea class="textarea" name="bio">{{$user->bio}}</textarea>

    </div>
    <div class="control">

        <button type="submit" class="button is-link">Update profil</button>
    </div>
    </div>
</form>

    </div>
</div>
@endsection

