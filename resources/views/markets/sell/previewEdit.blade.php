@extends('layout.site')

@section('title')
    Redigera annons: {{ $market->title }}
@stop

@section('content')
    <div class="inner-content">
        <h1>Redigera annons: {{ $market->title }}</h1>
        <hr />

        {!! Form::model($market, array('route' => 'markets.store' , 'files' => true )) !!}

        @include('markets.partials._marketCreate')

        {!! Form::submit('Publicera', array('class' => 'btn', 'name'=>'publishBB')); !!}
        {!! Form::submit('Förhandsgranska', array('class' => 'btn', 'name'=>'preview')); !!}

        {!! Form::close() !!}
    </div>

@stop