@extends('layout.site')

@section('title')
    Händelser för {{ $market->title or null }}
@stop

@section('content')
    <div class="inner-content">
        @foreach($events as $event)
            <div class="stripe">
                {{ $event->created_at }}, {{ $event->body }}
            </div>
        @endforeach
    </div>
@stop