@extends('layout.site')

@section('title')
	Skapa annons
@stop

@section('content')
	<div class="inner-content">
		<h1>Skapa ny säljesannons</h1>
		<hr />

		{!! Form::open(array('route' => 'markets.store' , 'files' => true )) !!}
        {!! Form::hidden('marketType', '0') !!}

		@include('markets.partials._marketCreate')

		{!! Form::submit('Publicera', array('class' => 'btn', 'name'=>'publishBB')); !!}
		{!! Form::submit('Förhandsgranska', array('class' => 'btn', 'name'=>'preview')); !!}

		{!! Form::close() !!}
	</div>

@stop