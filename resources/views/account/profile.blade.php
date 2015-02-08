@extends('account/_layout')

@section('title')
    {{ $user->username }}
@stop

@section('content')

    <h1> {{ $user->username }} </h1>
    <hr/>
    <br/>

    Vänster fält = Meny för användarinteraktion<br/>
    Dela upp nedan på flera olika sidor/delar.
    <br/>
    Ändra uppgifter<br/>
    Ändra lösenord<br/>
    Mina bud<br/>
    Koppla konto mot phpBB, Facebook, google (Openauth)
    Etc.<br/>
    <hr/>
    <br/>
    Höger fält = Aktuell interaktion<br/>

@stop