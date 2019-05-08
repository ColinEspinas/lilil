@extends('layouts.app')

@section('content')
<h1 class="background-title">{{ $user->pseudo }}</h1>
<div style="padding-bottom: 100px;"></div>
{{-- <div class="lil-row center">
    <div class="lil-col md-10-12 lg-8-12 xl-9-12">
        <div class="user-banner" style="background-image: url('https://picsum.photos/1920')">
            <div class="user-avatar" style="background-image: url('https://picsum.photos/800/800')"></div>
        </div>
    </div>
</div> --}}
<div class="lil-row center padding-tb-15">
    <div class="lil-col md-10-12 lg-8-12 xl-3-12">
        <h2>{{ $user->pseudo }} ({{ '@' . $user->name }}) </h2>
        <div class="stat-list">
            <li ><i data-feather="book-open"></i>{{ $user->bio ?? 'This user does not have any bio.' }}</li>
            <hr>
            <li><i data-feather="mail"></i>{{ $user->email }}</li>
            <li><i data-feather="clock"></i>Created {{ $user->getRegisterDateFromNow() }} ({{ $user->getRegisterDate() }})</li>
            <hr>
            <li class="stat-followers"><i data-feather="users"></i>789 followers</li>
            <li class="stat-follows"><i data-feather="user-check"></i>106 follows</li>
            <li class="stat-likes"><i data-feather="heart"></i>{{ $user->getMessageLikesCount() }} likes &
                {{ count($user->getLikedMessages()) }} liked</li>
                @if (Auth::User()->id == $user->id)
            <li><button onclick="location.href='/users/{{ Auth::User()->name }}/edit';" class="btn width-100"><i data-feather="settings"></i> Settings</button></li>
                @else
                    <li><button class="btn width-100"><i data-feather="user-plus"></i> Follow</button></li>
                @endif

        </div>
    </div>
    <div class="lil-col md-10-12 lg-8-12 xl-6-12">
        <h2>Messages</h2>
        @include('includes.messages')
    </div>
</div>
@endsection
