@extends('layouts.app')

@section('content')
<h1 class="background-title">{{ $user->pseudo }}</h1>
<div style="padding-bottom: 100px;"></div>
<div class="lil-row center">
    <div class="lil-col md-10-12 lg-8-12 xl-9-12">
        <div class="user-banner" style="background-image: url('https://picsum.photos/1400/300')">
            <div class="user-avatar" style="background-image: url('https://picsum.photos/800/800')"></div>
        </div>
    </div>
</div>
<div class="lil-row center padding-tb-15">
    <div class="lil-col md-10-12 lg-8-12 xl-3-12">
        <h2 class="section-title"><i data-feather="user"></i>{{ $user->pseudo }} ({{ '@' . $user->name }}) </h2>
        <div class="stat-list">
            <li><i data-feather="book-open"></i>{{ $user->bio ?? 'This user does not have any bio.' }}</li>
            <hr>
            <li><i data-feather="mail"></i>{{ $user->email }}</li>
            <li><i data-feather="clock"></i>Created {{ $user->getRegisterDateFromNow() }}
                ({{ $user->getRegisterDate() }})</li>
            <hr>
            <li class="stat-followers"><i data-feather="users"></i>{{ count($user->followers) }} followers</li>
            <li class="stat-follows"><i data-feather="user-check"></i>{{ count($user->follows) }} follows</li>
            <li class="stat-likes"><i data-feather="heart"></i>{{ $user->getMessageLikesCount() }} likes &
                {{ count($user->getLikedMessages()) }} liked</li>
            <li class="stat-shares"><i data-feather="repeat"></i>{{ Auth::user()->getMessageSharesCount() }} shares &
                {{ count(Auth::user()->getSharedMessages()) }} shared</li>

            @if (Auth::User()->id == $user->id)
            <li><button onclick="location.href='/users/{{ Auth::User()->name }}/edit';" class="btn width-100"><i
                        data-feather="settings"></i> Settings</button></li>
            @else
            @if (count(Auth::User()->follows->filter(function($follow) use ($user) { return $follow->followed->id ==
            $user->id; })->all()) > 0)
            <li><button class="btn width-100 active"
                    onclick="followBtnAnimation(this); ajax('/follows/{{ $user->id }}', 'PUT', '{{ csrf_token() }}');">
                    <i data-feather="user-minus"></i> Unfollow
                </button></li>
            @else
            <li><button class="btn width-100"
                    onclick="followBtnAnimation(this); ajax('/follows/{{ $user->id }}', 'PUT', '{{ csrf_token() }}');">
                    <i data-feather="user-plus"></i> Follow
                </button></li>
            @endif
            @endif
        </div>
    </div>
    <div class="lil-col md-10-12 lg-8-12 xl-6-12">
        <h2 class="section-title"><i data-feather="list"></i>Messages</h2>
        @include('includes.activities')
    </div>
</div>
@endsection
