@extends('layout/site')

@section('title')
    Inställningar - {{ Auth::user()->username }}

@stop

@section('content')
    <h1>Inställningar</h1>
    Funktionen inte inplementerad ännu<br/>
    <br/>
    Ändra uppgifter<br/>
    Ändra lösenord<br/>
    Koppla konto mot phpBB, Facebook, google (Openauth) Etc<br/>
@stop