@extends('account._partials._layout')

@section('title')
    Avslutade annonser - @Auth::user()->username
@stop

@section('content')
    <h1>Avslutade annonser</h1>
    @include('markets.base._marketsSmallList')
@stop