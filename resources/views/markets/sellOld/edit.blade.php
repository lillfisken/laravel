<!-- /var/www/lara/resources/views/markets/edit.blade.php -->

@extends('layout.site')

@section('title')
	Ändra annons
@stop

@section('content')
    <div class="inner-content">
        <h1>Ändra annons : {!! $market->title !!}</h1>
        {{--{!! Form::model($market, ['url' => 'markets/' . $market->id, 'method'=>'PATCH', 'files' => true]) !!}--}}
        {!! Form::model($market, ['url' => URL::route('markets.update', array($market->id)), 'method'=>'PATCH', 'files' => true]) !!}

            @include('markets.partials._marketCreate')

            {!! Form::submit('Uppdatera', array('class' => 'btn', 'name'=>'publishBB')); !!}
            {!! Form::submit('Förhandsgranska', array('class' => 'btn', 'name' => 'preview')); !!}

        {!! Form::close() !!}
    </div>
@stop