@extends('account/message/index')

@section('title')
    Nytt meddelande - @Auth::user()->username
@stop

@section('content')
    <h1>Nytt meddelande</h1>
    {!! Form::open(['route' => 'message.new']) !!}

    <h3 class="inline">{!! Form::label('recievers', 'Mottagare') !!}</h3> <span class="inline">(Användarnamn)</span>
    @if(isset($reciever))
        {!! Form::text('reciever', $reciever, ['class' => 'form-input'] ) !!}
    @else
        {!! Form::text('reciever', null, ['class' => 'form-input'] ) !!}
    @endif

        <h3>{!! Form::label('title', 'Titel') !!}</h3>
    @if(isset($title))
        {!! Form::text('title', $title , ['class' => 'form-input'] ) !!}
    @else
        {!! Form::text('title', null , ['class' => 'form-input'] ) !!}
    @endif

    <h3>{!! Form::label('message', 'Meddelande') !!}</h3>
    {!! Form::textarea('message', null , ['class' => 'form-input'] ) !!}<br/><br/>


    {!! Form::submit('Skicka', array('class' => 'btn-right')); !!}
    {!! Form::submit('Förhandsgranska', array('class' => 'btn-right')); !!}

    {!! Form::close() !!}
@stop