@extends('markets.base.create')

@section('numberOfItemsForSale')

@endsection

@section('contact')
    <h3>Välj hur säljarna ska kunna kontakta dig</h3>
    {!! $errors->first('contactPm', '<div class="help-block">:message</div>') !!}
    {!! $errors->first('contactMail', '<div class="help-block">:message</div>') !!}
    {!! $errors->first('contactPhone', '<div class="help-block">:message</div>') !!}
    {!! $errors->first('contactQuestions', '<div class="help-block">:message</div>') !!}

    {!! Form::label('contactPm', 'PM') !!}
    {!! Form::checkbox('contactPm', '1', true) !!}
    {!! Form::label('contactMail', 'Mail') !!}
    {!! Form::checkbox('contactMail', '1', true) !!}
    {!! Form::label('contactPhone', 'Telefon') !!}
    {!! Form::checkbox('contactPhone', '1', true) !!}
    {!! Form::label('contactQuestions', 'Via öppna frågor') !!}
    {!! Form::checkbox('contactQuestions', '1', true) !!}<br />
    <hr />
@endsection



