<!-- /var/www/lara/resources/views/markets/show.blade.php -->

@extends('layout/site')

@section('title')
	{{ $market->title }}
@stop

@section('content')
		
    @include('partials._marketShow')

@stop