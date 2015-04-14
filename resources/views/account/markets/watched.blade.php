@extends('account._partials._layout')

@section('title')
    Bevakade annonser - @Auth::user()->username
@stop

@section('content')
    <h1>Bevakade annonser</h1>
    @include('markets.partials._marketlist')
@stop