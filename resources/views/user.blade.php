@extends('layouts.app')

@section('content')
    <h1 class="background-title">{{ $user->pseudo }}</h1>
    <div style="padding-bottom: 100px;"></div>
    <div class="lil-row center padding-tb-15">
        <div class="lil-col md-10-12 lg-8-12 xl-3-12">
            <h2>User view</h2>
            <p>Name : {{ $user->name }}</p>

            <p>Pseudo : {{ $user->pseudo }}</p>

            <p>Mail : {{ $user->email }}</p>

            <p>Bio : {{ $user->bio ?? 'This user has no bio' }}</p>




        </div>
        <div class="lil-col md-10-12 lg-8-12 xl-6-12">

        </div>
    </div>

@endsection
