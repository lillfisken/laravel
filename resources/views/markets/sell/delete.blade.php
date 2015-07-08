{{--* Created by PhpStorm.--}}
{{--* User: Oskar--}}
{{--* Date: 2015-01-29--}}
{{--* Time: 22:18--}}

@extends('layout.site')

@section('title')
    Avsluta {{ $markets->title }}
@stop

@section('content')
    <div class="inner-content">
        <h1>Avsluta "{{ $markets->title }}"</h1>
        {!! Form::open(array('route' => 'markets.destroy' , 'method' => 'delete' )) !!}
            {!! Form::hidden('market', $markets->id ) !!}<br/>
            {!! Form::select('reason', $reasons) !!}

            {!! Form::submit('Avsluta', array('class' => 'btn')); !!}
        {!! Form::close() !!}

        Form to delete and choose reason
    </div>

@stop