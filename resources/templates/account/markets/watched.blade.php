@extends('account/_layout')

@section('title')
    Bevakade annonser - @Auth::user()->username
@stop

@section('content')
    <h1>Bevakade annonser</h1>
    @include('partials._marketlist')
@stop