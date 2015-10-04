@extends('account/message/index')

@section('title')
    @if(isset($title))
        {{ $title }}
    @else
        Visa meddelande
    @endif
    - {{ Auth::user()->username }}
@stop

@section('content')
    <div class="inner-content">
        <h1>{{ $messages->first()->conversation->title }}</h1>
        <hr/>
        {!! Form::open(['route' => 'message.send']) !!}
        {!! Form::hidden('conversationId', $messages->first()->conversation->id ) !!}
        {!! Form::textarea('message', null, ['class' => 'form-input']) !!}<br/>

        {!! Form::submit('Förhandsgranska (ej inplementerad)', ['class' => 'btnSmall']) !!}
        {!! Form::submit('Skicka', ['class' => 'btnSmall']) !!}

        {!! Form::close() !!}
        <hr/>
        {!! $messages->render() !!}
        @foreach($messages as $message)
            <div class="list-row">
                <h4 class="inline">{{ $message->sender->username or 'null' }}
                    @if( !$message->read && $message->senderId != \Illuminate\Support\Facades\Auth::Id() )
                        (Oläst)
                    @endif</h4>
                    <small class="align-right">{{ $message->created_at }}</small>
                <p>
                    {{ $message->message }}
                </p>
            </div>
        @endforeach
        {!! $messages->render() !!}
    </div>
@stop