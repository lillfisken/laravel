@extends('layout.site')

@section('title')
    Bevaka {{ $market->title }}

@stop

@section('content')
    <div class="inner-content">
        {!! Form::open(['route' => 'accounts.watchMarketPost']) !!}
            <h3>Vill du bevaka {{ $market->title }}?</h3>
            {!! Form::hidden('marketId', $market->id) !!}
            {!! Form::submit('Ja', ['class' => 'btn', 'name' => 'yes']) !!}
            {!! Form::submit('Nej', ['class' => 'btn', 'name' => 'no']) !!}
        {!! Form::close() !!}
    </div>
@stop