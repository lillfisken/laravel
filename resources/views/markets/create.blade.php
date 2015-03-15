<!-- /var/www/lara/resources/views/markets/create.blade.php -->

@extends('layout/site')

@section('title')
	Skapa annons
@stop

@section('content')
	<div class="inner-content">
		<h1>Skapa ny annons</h1>
		<hr />

		{!! Form::open(array('route' => 'markets.store' , 'files' => true )) !!}

		@include('partials._marketCreate')

		{!! Form::submit('Publicera', array('class' => 'btn-right', 'name'=>'publish')); !!}
		{!! Form::submit('Förhandsgranska', array('class' => 'btn-right', 'name'=>'preview')); !!}

		{!! Form::close() !!}
	</div>

@stop