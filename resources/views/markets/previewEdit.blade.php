@extends('layout/site')

@section('title')
    Redigera annons: {{ $market->title }}
@stop

@section('content')
    <div class="inner-content">
        <h1>Redigera annons: {{ $market->title }}</h1>
        <hr />

        {!! Form::model($market, array('route' => 'markets.store' , 'files' => true )) !!}

        @include('partials._marketCreate')

        {!! Form::submit('Publicera', array('class' => 'btn-right', 'name'=>'publish')); !!}
        {!! Form::submit('Förhandsgranska', array('class' => 'btn-right', 'name'=>'preview')); !!}

        {!! Form::close() !!}
    </div>

@stop