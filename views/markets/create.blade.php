<!-- /var/www/lara/resources/views/markets/create.blade.php -->

@extends('layout/site')

@section('title')
	Skapa annons
@stop

@section('content')
	<h1>Skapa ny annons</h1>
	<hr />

	{!! Form::open(array('route' => 'markets.store' , 'files' => true )) !!}
		
	@include('markets._market')
			
	{!! Form::submit('Publicera', array('class' => 'btn-right')); !!}
	{!! Form::submit('Förhandsgranska', array('class' => 'btn-right')); !!}
		
	{!! Form::close() !!}

@stop