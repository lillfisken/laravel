@extends('account._partials._layout')

@section('title')
    Bevakade annonser - @Auth::user()->username
@stop

@section('content')
    <div class="inner-content">
        <h1>Bevakade annonser</h1>
        @include('markets.base._marketsSmallList')
    </div>
@stop