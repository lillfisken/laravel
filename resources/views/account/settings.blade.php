@extends('layout/site')

@section('title')
    Inställningar - {{ Auth::user()->username }}

@stop

@section('content')
    <h1>Inställningar</h1>
    Funktionen inte inplementerad ännu<br/>
    <br/>
    Presentationstext
    <hr/>
    Telefonnr:<br/>
    Visa mitt telefonnr i profilen
    <hr>
    E-mail<br/>
    Visa min e-mail i profilen
    <hr>
    Adress<br/>
    Visa ort i profilen
    <hr>
    Lösenord<br/>
    Upprepa lösenord
    <hr>
    Kopplingar: <br/>
    Elektronikforumet (PhpBB), visa mitt användarnamn i profilen<br/>
    Google<br/>
    Facebook<br>
    Twitter<br/>
    <hr>
    Lösenord<br/>
    Upprepa lösenord
    <hr/>

@stop