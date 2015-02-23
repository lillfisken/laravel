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
    <h1>{{ $messages->first()->conversation->title }}</h1>

    {!! Form::open(['route' => 'message.send']) !!}
    {!! Form::hidden('conversationId', $messages->first()->conversation->id ) !!}
    {!! Form::textarea('message', null, ['class' => 'form-input']) !!}<br/>

    {!! Form::submit('Förhandsgranska (ej inplementerad)', ['class' => '']) !!}
    {!! Form::submit('Skicka', ['class' => '']) !!}

    {!! Form::close() !!}

    <?php $count = 1; ?>
    @foreach($messages as $message)
        <div class="list-row @if( $count == 1 )row-dark {{ $count = 0 }} @else {{ $count = 1 }} @endif ">
            <h4 class="inline">{{ $message->sender->username or 'null' }}
                @if( !$message->read )
                    (Nytt)
                @endif</h4>
                <small class="align-right">{{ $message->created_at }}</small>
            <p>
                {{ $message->message }}
            </p>
        </div>
    @endforeach

@stop