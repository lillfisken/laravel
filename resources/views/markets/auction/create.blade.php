@extends('markets.base.create')

@section('market-price-settings')
    <h3>{!! Form::label('price', 'Utropspris *') !!}</h3>
    {!! $errors->first('price', '<div class="help-block">:message</div>') !!}
    {!! Form::text('price', null, ['class' => 'form-input'] ) !!}

    <h3>{!! Form::label('end_at', 'Sluttid *') !!}</h3>
    {!! $errors->first('end_at', '<div class="help-block">:message</div>') !!}
    {!! Form::text('end_at', null, ['id'=>'endAtInput', 'class' => 'form-input'] ) !!}
@endsection

@section('numberOfItemsForSale')
    {{--Should not exist--}}
@endsection


