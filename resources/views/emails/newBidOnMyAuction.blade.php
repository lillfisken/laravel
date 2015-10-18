@extends('emails/master')

@section('content')
    <h3>Hej {{ $auction->user->username or 'null' }}</h3>
    <p>Du har fått ett nytt bud på din auction {{ $auction->title or 'null' }}</p>
    <p>Nytt bud: {{ $bid->bid or 'null' }} från {{ $bidder->username or 'null' }}, klockan {{ $bid->updated_at or 'null' }}</p>
    <p><a href="{{ route('auction.show', [$auction->id]) }}">{{ route('auction.show', [$auction->id]) }}</a> </p>
@stop
