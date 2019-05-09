@extends('layouts.app')

@section('content')

    <h1>Page de recherche</h1>
   <form action="/search" method="get">

       <input type="search" name="search">
       <button type="submit">Search user</button>



   </form>

@endsection