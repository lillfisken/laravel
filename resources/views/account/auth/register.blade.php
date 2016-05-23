@extends('layout.site')

@section('title')
    Ny användare
@stop

@section('content')
    <div class="inner-content">

        {!! Form::open(['route' => 'accounts.register.post']) !!}

        <table class="table-100">
            <tr>
                <td colspan="2">
                    <h1>Registrera nytt konto</h1>
                    <p class="wrap">
                        Lite text här som hälsar välkommen, som informerar om reglerna användaren godkänner genom att registrera sig samt information om att man efter registrering kan välja att koppla kontot till diverse externa inloggningar såsom Elektronikforumet, Google, Twitter och Facebook.
                    </p>
                </td>
            </tr>
            <tr><td colspan="2"><hr/></td></tr>
            @include('account._partials._profileForm')
            <tr>
                <td colspan="2">
                    <h3>Användarnamn:</h3>
                </td>
            </tr>
            {!! $errors->first('username', '<tr><td colspan="2"><div class="help-block">:message</div></td></tr>') !!}
            <tr>
                <td>
                    {!! Form::label('username', 'Användarnamn') !!}<br/>
                </td>
                <td>
                    {!! Form::text('username' , null, ['class' => "form-input" , 'placeholder'=>'Användarnamn'] ) !!}
                </td>
            </tr>
            <tr><td colspan="2"><hr/></td></tr>
            <tr>
                <td colspan="2">
                    <h3>Lösenord:</h3>
                </td>
            </tr>
            {!! $errors->first('password', '<tr><td colspan="2"><div class="help-block">:message</div></td></tr>') !!}
            <tr>
                <td>
                    {!! Form::label('password', 'Lösenord') !!}<br/>
                </td>
                <td>
                    {!! Form::password('password' , ['class' => "form-input" , 'placeholder'=>'Lösenord'] ) !!}
                </td>
            </tr>
            <tr>
                <td>
                    {!! Form::label('password_confirmation', 'Upprepa lösenord') !!}<br/>
                </td>
                <td>
                    {!! Form::password('password_confirmation' , ['class' => 'form-input', 'placeholder'=>'Upprepa lösenord' ] ) !!}
                </td>
            </tr>
            <tr><td colspan="2"><hr/></td></tr>
        </table>

        {!! Form::submit('Skapa konto', array('class' => 'btn')) !!}

        {!! Form::close() !!}
    </div>
@stop
