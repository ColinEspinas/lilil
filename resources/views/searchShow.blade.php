@extends('layouts.app')

@section('content')

@foreach($users as $users)
    <li> <a href="/users/{{$users->name}}">name : {{$users->name}}</a></li>
@endforeach
@endsection