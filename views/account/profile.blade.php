@extends('layout/site')

@section('title')
    {{ $user->username }}
@stop

@section('content')

    <h1> {{ $user->username }} </h1>
    <hr/>
    <br/>

    Vänster fält = Meny för användarinteraktion<br/>
    <br/>
    Ändra uppgifter<br/>
    Ändra lösenord<br/>
    Visa mina annonser<br/>
    Visa mina blockerade säljare<br/>
    Visa blockerade annonser<br/>
    Mina bud<br/>
    Etc.<br/>
    <hr/>
    <br/>
    Höger fält = Aktuell interaktion<br/>
    <br/>

@stop