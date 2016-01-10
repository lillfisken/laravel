@extends('account._partials._layout')

@section('title')
    Bevakade annonser - @Auth::user()->username
@stop

@section('content')
    <div class="inner-content">
        <div class="flex-row">
            <div class="flex-left">
                <h1>Bevakade annonser</h1>
            </div>
            <div class="flex-right">
                @include('markets.base._listType')
            </div>
        </div>
        @include('markets.base._marketsSmallList')
    </div>
@stop