@extends('markets.base.create')

@section('formOpen')
    {!! Form::model($model, ['route' => $callbackRoute , 'files' => true ]) !!}
    {{--{!! Form::hidden('type', $type) !!}--}}
@endsection

@section('market-price-settings')
    <h3>{!! Form::label('price', 'Utropspris *') !!}</h3>
    {!! $errors->first('price', '<div class="help-block">:message</div>') !!}
    {!! Form::text('price', null, ['class' => 'form-input'] ) !!}

    {{--<h3>{!! Form::label('endingDate', 'Slutdatum') !!}</h3>--}}
    {{--{!! $errors->first('endingDate', '<div class="help-block">:message</div>') !!}--}}
    {{--{!! Form::text('endingDate', null, ['class' => 'form-input'] ) !!}--}}

    {{--<h3>{!! Form::label('endingTime', 'Sluttid') !!}</h3>--}}
    {{--{!! $errors->first('endingTime', '<div class="help-block">:message</div>') !!}--}}
    {{--{!! Form::text('endingTime', null, ['class' => 'form-input'] ) !!}--}}

    <h3>{!! Form::label('end_at', 'Sluttid *') !!}</h3>
    {!! $errors->first('end_at', '<div class="help-block">:message</div>') !!}
    {!! Form::text('end_at', null, ['id'=>'endAtInput', 'class' => 'form-input'] ) !!}

@endsection

@section('numberOfItemsForSale')

@endsection

{{--@section('formClose')--}}
    {{--@foreach($buttons as $button)--}}
        {{--{{ $button[''] }}--}}
    {{--@endforeach--}}
    {{--{!! Form::submit('Publicera', array('class' => 'btn', 'name'=>'publishBB')); !!}--}}
    {{--{!! Form::submit('Förhandsgranska', array('class' => 'btn', 'name'=>'preview')); !!}--}}

    {{--{!! Form::close() !!}--}}
{{--@endsection--}}


