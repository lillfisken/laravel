@extends('layout/site')

@section('title')
    Nytt meddelande - @Auth::user()->username
@stop

@section('content')
    <h1>Nytt meddelande</h1>
    {{--@include('partials.errors.basic')--}}
    {!! Form::open(['route' => 'message.new']) !!}

    <h3 class="inline">{!! Form::label('recievers', 'Mottagare') !!}</h3> <span class="inline">(Användarnamn)</span>
    {!! $errors->first('reciever', '<div class="help-block">:message</div>') !!}
    @if(isset($reciever))
        {!! Form::text('reciever', $reciever, ['class' => 'form-input full-width'] ) !!}
    @else
        {!! Form::text('reciever', null, ['class' => 'form-input full-width'] ) !!}
    @endif

    <h3>{!! Form::label('title', 'Titel') !!}</h3>
    {!! $errors->first('title', '<div class="help-block">:message</div>') !!}
    @if(isset($title))
        {!! Form::text('title', $title , ['class' => 'form-input full-width'] ) !!}
    @else
        {!! Form::text('title', null , ['class' => 'form-input full-width'] ) !!}
    @endif

    <h3>{!! Form::label('message', 'Meddelande') !!}</h3>
    {!! $errors->first('message', '<div class="help-block">:message</div>') !!}
    {!! Form::textarea('message', null , ['class' => 'form-input full-width'] ) !!}<br/><br/>

    {!! Form::submit('Skicka', array('class' => 'btn')) !!}
    {!! Form::submit('Förhandsgranska', array('class' => 'btn')) !!}
    {!! Form::close() !!}
@stop