@extends('layouts.app')

@section('content')
<h1 class="background-title">{{ $pageName }}</h1>
<div style="padding-bottom: 100px;"></div>
<div class="lil-row center padding-tb-15">
    <div class="lil-col md-10-12 lg-8-12 xl-3-12">
        <h2 class="section-title"><i data-feather="activity"></i>My Stats</h2> 
        @include('includes.stats')
    </div>
    <div class="lil-col md-10-12 lg-8-12 xl-6-12">
        <h2 class="section-title"><i data-feather="heart"></i>Liked messages</h2>
        @include('includes.messages')
    </div>
</div>

@endsection
