<!-- /var/www/lara/resources/views/markets/show.blade.php -->

@extends('layout/site')

@section('title')
	{{ $market->title }}
@stop

@section('content')
		
    @include('markets.partials._marketShow')

@stop