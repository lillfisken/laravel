@extends('account/_layout')

@section('title')
    Blockerade annonser - @Auth::user()->username
@stop

@section('content')
    <h1>Blockerade annonser</h1>
    @include('partials._marketlist')
@stop