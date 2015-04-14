@extends('account._partials._layout')

@section('title')
    Blockerade annonser - @Auth::user()->username
@stop

@section('content')
    <h1>Blockerade annonser</h1>
    @include('markets.partials._marketlist')
@stop