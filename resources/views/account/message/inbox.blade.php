@extends('account/message/index')

@section('title')
    Inkorg - {{ Auth::user()->username }}
@stop

@section('content')
    <div class="inner-content">
        <h1>Inkorg</h1>
        <hr/>
        {!! $conversations->render() !!}
        @foreach($conversations as $conversation)
            @if($conversation->messages->count() > 0)
                <div class="list-row">
                    <a href="{{ route('message.show', $conversation->id) }}">
                        <h3 class="inline">{{ $conversation->title }}
                            @if($conversation->unread != 0)
                                <span class="badge">{{ $conversation->unread }}</span>
                            @endif
                        </h3>
                        <small class="align-right">Senaste meddelande {{ $time->parseTimeAndDateFromUnixToString($conversation->latestMessage) }},
                        {{--<small class="align-right">Senaste meddelande {{ $conversation->messages->last()->created_at }},--}}
                            {{ $conversation->sender }}</small>
                        <p>
                            {{--{{ $conversation->user1()->get()->first()->username }},--}}
                            {{--{{ $conversation->user2()->get()->first()->username }},--}}
                            {{--{{ $conversation->user2 }},--}}
                            {{ $conversation->username1 }} <>
                            {{ $conversation->username2 }} |
                            {{ $conversation->messages->count() }} meddelande,
                        </p>
                    </a>
                </div>
            @endif
        @endforeach
        {!! $conversations->render() !!}
    </div>
@stop