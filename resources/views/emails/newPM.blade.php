@extends('emails/master')

@section('content')
    <h3>Hej {{ $receiver['username'] or 'null' }}</h3>
    <p>Du har fått ett nytt PM från {{ $sender['username'] or 'null' }} {{ $pm['conversation']['updated_at'] or 'null'}}</p>
    <hr/>
    <h4>{{ $pm['conversation']['title'] or 'null'}}</h4>
    <p>{{ $pm['message'] or 'null'}}</p>
@stop

