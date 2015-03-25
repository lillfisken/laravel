@extends('layout/site')

@section('title')
    Mail
@stop

@section('content')
    <h1>Mail</h1>
    <div>
        {!! Form::open(['route' => 'message.mail']) !!}

        <h3 class="inline">{!! Form::label('toUser', 'Mottagare') !!}</h3> <span class="inline">(Användarnamn)</span>
        @if(isset($toUser))
            {!! Form::text('toUser', $toUser, ['class' => 'form-input'] ) !!}
        @else
            {!! Form::text('toUser', null, ['class' => 'form-input'] ) !!}
        @endif

        <h3 class="inline">{!! Form::label('title', 'Titel') !!}</h3>
        @if(isset($title))
            {!! Form::text('title', $title, ['class' => 'form-input'] ) !!}
        @else
            {!! Form::text('title', null, ['class' => 'form-input'] ) !!}
        @endif

        <h3 class="inline">{!! Form::label('message', 'Meddelande') !!}</h3>
        @if(isset($message))
            {!! Form::textarea('message', $message, ['class' => 'form-input'] ) !!}
        @else
            {!! Form::textarea('message', null, ['class' => 'form-input'] ) !!}
        @endif

        {!! Form::submit('Skicka') !!}
        {!! Form::close() !!}
    </div>
@stop