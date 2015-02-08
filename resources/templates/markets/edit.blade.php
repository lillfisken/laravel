<!-- /var/www/lara/resources/views/markets/edit.blade.php -->

@extends('layout/site')

@section('title')
	Ändra annons
@stop

@section('content')
	<h1>Ändra annons : 
	{!! $market->title !!}</h1>
	{!! Form::model($market, ['url' => 'markets/' . $market->id, 'method'=>'PATCH', 'files' => true]) !!}

		@include('partials._market')
		
		{!! Form::submit('Uppdatera', array('class' => 'btn-right')); !!}
		{!! Form::submit('Förhandsgranska', array('class' => 'btn-right')); !!}

	{!! Form::close() !!}
@stop