@extends('layout.site')

@section('title')
    Avsluta {{ $market->title }}
@stop

@section('content')
    <div class="inner-content">
        <h1>Avsluta "{{ $market->title }}"</h1>
        <p>
            Välj anledning till avslut:
        </p>
        {!! Form::open(array('route' => $callBackRoute , 'method' => 'delete' )) !!}
            {!! Form::hidden('market', $market->id ) !!}<br/>
            {!! Form::select('reason', $reasons) !!}

            {!! Form::submit('Avsluta', array('class' => 'btn')); !!}
        {!! Form::close() !!}
    </div>

@stop