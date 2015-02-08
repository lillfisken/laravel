@extends('account/_layout')

@section('title')
    Aktiva annonser - @Auth::user()->username
@stop

@section('content')
    <h1>Aktiva annonser</h1>
    @include('partials._marketlist')
@stop