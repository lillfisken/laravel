@extends('layout/site')

@section('title')
    Mail
@stop

@section('content')
    <h1>Mail</h1>
    <div>
        {!! Form::open(['route' => 'message.mail']) !!}

        <h3 class="inline">{!! Form::label('toUser', 'Mottagare') !!}</h3> <span class="inline">(Användarnamn)</span>
        {!! Form::text('toUser', null, ['class' => "form-input"]) !!}

        <h3 class="inline">{!! Form::label('title', 'Titel') !!}</h3>
        {!! Form::text('title', null, ['class' => "form-input"]) !!}

        <h3 class="inline">{!! Form::label('message', 'Meddelande') !!}</h3>
        {!! Form::textarea('message', null, ['class'=>"form-input"]) !!}


        {!! Form::submit('Skicka') !!}
        {!! Form::close() !!}
    </div>
@stop