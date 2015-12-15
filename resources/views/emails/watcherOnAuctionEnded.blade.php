@extends('emails/master')

@section('content')
    <h3>{{ $title }}</h3>
    <p>Hej {{ $receiver->username }}</p>
    <p>En auktion du bevakar har avslutats, här kommer högsta budet att stå eller avskutats utan bud.</p>
@stop