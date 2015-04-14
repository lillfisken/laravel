@extends('account._partials._layout')

@section('title')
    Aktiva annonser - @Auth::user()->username
@stop

@section('content')
    <h1>Aktiva annonser</h1>
    @include('markets.partials._marketlist')
@stop