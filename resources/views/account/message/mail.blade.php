@extends('layout/site')

@section('title')
    Mail
@stop

@section('content')
    <h1>Mail</h1>
    <div>
        {!! Form::open(['route' => 'message.mail']) !!}

        <h3 class="inline">{!! Form::label('toUser', 'Mottagare') !!}</h3> <span class="inline">(Användarnamn)</span>
        {!! $errors->first('toUser', '<div class="help-block">:message</div>') !!}
        @if(isset($toUser))
            {!! Form::text('toUser', $toUser, ['class' => 'form-input full-width'] ) !!}
        @else
            {!! Form::text('toUser', null, ['class' => 'form-input full-width'] ) !!}
        @endif

        <h3 class="inline">{!! Form::label('title', 'Titel') !!}</h3>
        {!! $errors->first('title', '<div class="help-block">:message</div>') !!}
        @if(isset($title))
            {!! Form::text('title', $title, ['class' => 'form-input full-width'] ) !!}
        @else
            {!! Form::text('title', null, ['class' => 'form-input full-width'] ) !!}
        @endif

        <h3 class="inline">{!! Form::label('message', 'Meddelande') !!}</h3>
        {!! $errors->first('message', '<div class="help-block">:message</div>') !!}
        @if(isset($message))
            {!! Form::textarea('message', $message, ['class' => 'form-input full-width'] ) !!}
        @else
            {!! Form::textarea('message', null, ['class' => 'form-input full-width'] ) !!}
        @endif

        {!! Form::submit('Skicka', ['class' => 'btn']) !!}
        {!! Form::close() !!}
    </div>
@stop