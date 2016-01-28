<!-- /var/www/lara/resources/views/markets/index.blade.php -->

@extends('/layout/site')

@section('title')
    Visa annonser
@stop

@section('content')

    @include('markets.partials._filter')
    <!-- ---------------------------------------------------------------------------- -->
    <!-- Market listings, list -->

    @include('markets.base._marketsSmallList')

@stop
