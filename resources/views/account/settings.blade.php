@extends('layout/site')

@section('title')
    Inställningar - {{ $user()->username }}

@stop

@section('content')
    {!! Form::model($user, ['route' => 'accounts.save']) !!}
    <h1>Inställningar</h1>
    Funktionen inte inplementerad ännu<br/>
    <br/>
    Presentationstext
    <hr/>
    {!! Form::label('phone1', 'Telefonnr: ') !!}
    {!! Form::text('phone1', null , ['class' => ''] ) !!}<br/>
    {!! Form::label('phoneAllowed', 'Visa mitt telefonnr i profilen') !!}
    {!! Form::checkbox('phoneAllowed', '1', true) !!}
    <hr>
    {!! Form::label('email', 'E-mail: ') !!}
    {!! Form::text('email', null , ['class' => ''] ) !!}<br/>
    {!! Form::label('emailAllowed', 'Visa min e-mail i profilen') !!}
    {!! Form::checkbox('emailAllowed', '1', true) !!}
    <hr>
    Namn <br/>
    Adress<br/>
    Visa ort i profilen
    <hr>
    {!! Form::label('pswdOld', 'Gammalt lösenord (behövs om du ska byta): ') !!}
    {!! Form::password('pswdOld') !!}<br/>
    {!! Form::label('pswd', 'Nytt lösenord: ') !!}
    {!! Form::password('pswd') !!}<br/>
    {!! Form::label('pswd2', 'Upprepa lösenord: ') !!}
    {!! Form::password('pswd2') !!}<br/>
    <hr>
    Kopplingar: <br/>
    Elektronikforumet (PhpBB), visa mitt användarnamn i profilen<br/>
    Google<br/>
    Facebook<br>
    Twitter<br/>
    <hr>

    {!! Form::submit('Spara') !!}
    {!! Form::close() !!}
@stop