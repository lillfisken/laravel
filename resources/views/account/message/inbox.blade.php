@extends('layout/site')

@section('title')
    Inkorg - {{ Auth::user()->username }}
@stop

@section('content')
    <div class="inner-content">
        <h1 class="dark-border-bottom">PM</h1>
        {{--<hr/>--}}
        {!! $conversations->render() !!}
        @foreach($conversations as $conversation)
            @if($conversation->messages->count() > 0)
                <div class="pm-line" style="padding-top: 5px; padding-bottom: 5px">
                    <a href="{{ route('message.show', $conversation->id) }}">
                        <div class="flex-container flex-space-between">
                            <h3 class="inline">{{ $conversation->title }}
                                @if($conversation->unread != 0)
                                    {{--<span class="badge">{{ $conversation->unread }}</span>--}}
                                <span class="badge-container">
                                    <span class="fa-stack fa-1x">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <span class="fa-stack-1x text-primary"><span class="badge-text">{{ $conversation->unread }}</span></span>
                                    </span>
                                </span>
                                @endif
                            </h3>
                            <small class="align-right">
                                Senaste
                                meddelande {{ $time->parseTimeAndDateFromUnixToString($conversation->latestMessage) }},
                                <strong>{{ $conversation->sender }}</strong>
                            </small>
                        </div>
                        <p>
                            {{ $conversation->username1 }} -
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