@extends('emails/master')

@section('content')
    <h3>Hej {{ $receiver->username }}</h3>
    <p>Du har vunnit {{ $auction->title }}.</p>
    <p>Vänligen ta kontakt med {{ $sender->username }} och gör upp vidare om affären.</p>
@stop
