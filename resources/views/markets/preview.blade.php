<!-- /var/www/lara/resources/views/markets/show.blade.php -->

@extends('layout/site')

@section('title')
    Förhandsgranska {{ $market->title }}
@stop

@section('content')
    <div class="clearfix padding5">
        <h1 class="inline">FÖRHANDSGRANSKA</h1>
        {!! Form::model($market, array('route' => 'markets.store')) !!}
        {!! Form::hidden('createdByUser') !!}
        {!! Form::hidden('title') !!}
        {!! Form::hidden('marketType') !!}
        {!! Form::hidden('description') !!}
        {!! Form::hidden('price') !!}
        {!! Form::hidden('extra_price_info') !!}
        {!! Form::hidden('numberOfItems') !!}
        {!! Form::hidden('image1') !!}
        {!! Form::hidden('image2') !!}
        {!! Form::hidden('image3') !!}
        {!! Form::hidden('image4') !!}
        {!! Form::hidden('image5') !!}
        {!! Form::hidden('image6') !!}
        {!! Form::hidden('contactPm') !!}
        {!! Form::hidden('contactMail') !!}
        {!! Form::hidden('contactPhone') !!}
        {!! Form::hidden('contactQuestion') !!}
        {!! Form::submit('Publicera', ['name'=>'publish']) !!}
        {!! Form::submit('Ändra', ['name'=>'edit']) !!}
        <hr/>
    </div>
    <div class="clearfix">
        @include('partials._marketShow')
    </div>

    <div class="clearfix padding5">
        <hr/>
        <h1>FÖRHANDSGRANSKA</h1>
        {!! Form::submit('Publicera', ['name'=>'publish']) !!}
        {!! Form::submit('Ändra', ['name'=>'edit']) !!}
        {!! Form::close() !!}
    </div>
@stop
