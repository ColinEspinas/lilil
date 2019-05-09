@extends('layouts.app')

@section('content')

<h1 class="background-title">Search</h1>
<div style="padding-bottom: 100px;"></div>
<div class="lil-row center padding-tb-15">
    <div class="lil-col md-10-12 lg-8-12 xl-3-12">
        <h2 class="section-title"><i data-feather="activity"></i>My Stats</h2> 
        @include('includes.stats')
    </div>
    <div class="lil-col md-10-12 lg-8-12 xl-6-12">
        <h2 class="section-title"><i data-feather="search"></i>Search</h2>
        <form class="search-form" action="/search" method="get">
        <input type="text" name="search" class="width-50" placeholder="Search for a user name/pseudo." value="{{ $search }}">
            <button type="submit" class="btn"><i data-feather="search"></i></button>
        </form>
        <a href="#messages" class="btn block margin-tb-15 text-center" ><i data-feather="arrow-down"></i>Go to messages</a>
        <ul id="users" class="user-search-results">
            @foreach($users as $user)
                <li class="user-search-item"><a href="/users/{{$user->name}}">{{$user->pseudo}} ({{"@".$user->name}})</a></li>
            @endforeach
        </ul>
        <a href="#users" class="btn block margin-tb-15 text-center"  ><i data-feather="arrow-up"></i> Go to users</a>

        <div id="messages">
            @include('includes.messages')
        </div>
    </div>
</div>


@endsection