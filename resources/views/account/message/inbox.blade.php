@extends('account/message/index')

@section('title')
    Inbox - {{ Auth::user()->username }}
@stop

@section('content')
    <h1>Inbox</h1>

    <?php $count = 1; ?>
    @foreach($conversations as $conversation)
        @if($conversation->messages->count() > 0)
            <a href="{{ route('message.show', $conversation->id) }}">
                <div class="list-row @if( $count == 1 )row-dark {{ $count = 0 }} @else {{ $count = 1 }} @endif ">
                    <h3 class="inline">{{ $conversation->title }}</h3>
                    <small class="align-right">Senaste meddelande {{ $conversation->messages->last()->created_at }},
                        {{ $conversation->messages->last()->sender->username }}</small>
                    <p>
                        {{ $conversation->messages->first()->sender->username }},
                        {{ $conversation->messages->count() }} meddelande,
                        Antal olästa ???,
                        Deltagare
                    </p>
                </div>
            </a>
        @endif
    @endforeach

@stop