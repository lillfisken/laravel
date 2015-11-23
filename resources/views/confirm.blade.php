@extends('layout/site')

@section('title')
    {{ $title }}
@stop

@section('content')
    <div class="inner-content">
        {!! Form::open(['route' => $callbackRoute]) !!}
            <h3>{{ $text }}</h3>
            {!! Form::hidden('hidden', $hidden) !!}
            {!! Form::submit('Ja', ['class' => 'btn', 'name' => 'yes']) !!}
            {!! Form::submit('Nej', ['class' => 'btn', 'name' => 'no']) !!}
        {!! Form::close() !!}
    </div>
@stop
