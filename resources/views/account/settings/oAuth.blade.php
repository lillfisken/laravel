@extends('layout.site')

@section('title')
    Inställningar - {{ $user->username }}
@stop

@section('content')
    <div class="inner-content">
        <h3>Externa kopplingar</h3>

        <table class="table-100">
        <colgroup>
            <col width="auto"/>
            <col width="100%"/>
        </colgroup>
        <tr><td colspan="2"><hr/></td></tr>

        <tr><td colspan="2">
            <p class="wrap">
                Uppdatera dina inlogningar på respektive forum.<br/>
                Om du redan ärinloggad på respektive forum kommer datan att uppdateras, annars kommer du ombeds ange dina inloggningsuppgifter.<br/>
                Inga andra data än ditt användarnamn delas.
            </p>
        </td></tr>

        @foreach($phpBBRegistered as $phpBB)
            <tr>
                {!! Form::open(['route' => ['phpBB.register', $phpBB['id'] ] ]) !!}
                <td colspan="2">
                    {!! Form::submit('Ändra användare, ' . $phpBB['displayName'] . ', Nuvarande: ' . $phpBB['username'], ['class'=>'btnSmall btn100']) !!}
                </td>
                {!! Form::close() !!}
            </tr>
        @endforeach

        <tr><td colspan="2"><hr/></td></tr>

        <tr><td colspan="2">
            <p class="wrap">
                Lägg till respektive forum för att användas vid inloggning.<br/>
                Om du redan är inloggad på respektive forum kommer datan att hämtas, annars kommer du ombeds ange dina inloggningsuppgifter.<br/>
                Inga andra data än ditt användarnamn delas.
            </p>
        </td></tr>

        @foreach($phpBBNonRegistered as $phpBB)
            <tr>
                {!! Form::open(['route' => ['phpBB.register', $phpBB["id"] ] ]) !!}
                <td colspan="2">
                    {!! Form::submit('Lägg till ' . $phpBB['displayName'], ['class'=>'btnSmall btn100']) !!}
                </td>
                {!! Form::close() !!}
            </tr>
        @endforeach

        <tr><td colspan="2"><hr/></td></tr>
    </table>
    </div>
@stop