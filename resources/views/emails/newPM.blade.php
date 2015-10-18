@extends('emails/master')

@section('content')
    <h3>Hej {{ $receiver->username or 'null' }}</h3>
    <p>Du har fått ett nytt PM från {{ $sender->username or 'null' }} {{ $pm->conversation->updated_at }}</p>
    <hr/>
    <h4>{{ $pm->conversation->title }}</h4>
    <p>{{ $pm->message }}</p>
@stop
