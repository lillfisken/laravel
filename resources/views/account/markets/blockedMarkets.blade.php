@extends('account._partials._layout')

@section('title')
    Blockerade annonser - @Auth::user()->username
@stop

@section('content')
    <div class="inner-content">
        <h1>Blockerade annonser</h1>
        @include('markets.base._marketsSmallList')
    </div>
@stop