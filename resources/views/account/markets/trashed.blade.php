@extends('account._partials._layout')

@section('title')
    Avslutade annonser - @Auth::user()->username
@stop

@section('content')
    <div class="flex-row">
        <div class="flex-left">
            <h1>Avslutade annonser</h1>
        </div>
        <div class="flex-right">
            @include('markets.base._listType')
        </div>
    </div>
    @include('markets.base._marketsSmallList')
@stop