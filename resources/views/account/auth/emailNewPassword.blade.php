@extends('layout.site')

@section('title')
    Glöm lösenord
@stop

@section('content')
    <div class="inner-content">
        {!! Form::open(['route' => 'accounts.forgotPasswordPost']) !!}
        <table class="table-100">
            <colgroup>
                <col width="auto"/>
                <col width="100%"/>
            </colgroup>
            <tr>
                <td colspan="2">
                    <h1>Återställ lösenord</h1>
                    <p>
                        En länk för att återställa lösenordet kommer att skickas till din mailadress. Länken är giltlig {{ config('auth.reminder.expire', 60) }} minuter.
                    </p>
                </td>
            </tr>
            <tr><td colspan="2"><hr/></td></tr>
            {!! $errors->first('email', '<tr><td colspan="2"><div class="help-block">:message</div></td></tr>') !!}
            <tr>
                <td>
                    {!! Form::label('email', 'E-mail:') !!}
                </td>
                <td>
                    {!! Form::email('email', null, ['class' => 'form-input']) !!}
                </td>
            </tr>
            <tr><td colspan="2"><hr/></td></tr>
        </table>
        {!! Form::submit('Skicka', ['class'=>'btn']) !!}
        {!! Form::close() !!}
    </div>
@stop