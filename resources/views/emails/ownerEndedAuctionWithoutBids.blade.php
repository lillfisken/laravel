@extends('emails/master')

@section('content')
    <h3>Hej {{ $receiver->username }}</h3>
    <p>Din auktion "{{ $auction->title }}" har avslutats utan något vinnande bud. Vi önskar dig lycka till med att sälja den framöver.</p>
@stop
