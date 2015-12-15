@extends('emails/master')

@section('content')
    <h3>Hej {{ $receiver->username }}</h3>
    <p>Din auktion "{{ $auction->title }}" har avslutats med det vinnande budet {{ $highestBid->bid }} från {{ $highestBid->user->username }}.</p>
    <p>Vänligen ta kontakt med {{ $highestBid->user->username }} för att slutföra affären.</p>
@stop
