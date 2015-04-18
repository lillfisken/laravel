@extends('layout.site')

@section('title')
    Glöm lösenord
@stop

@section('content')
    <div class="inner-content">
        {!! Form::open(['route' => 'accounts.resetPasswordPost']) !!}
        {!! form::hidden('token', $token) !!}
        <table class="table-100">
            <colgroup>
                <col width="auto"/>
                <col width="100%"/>
            </colgroup>
            <tr>
                <td colspan="2">
                    <h1>Återställ lösenord</h1>
                </td>
            </tr>
            <tr><td colspan="2"><hr/></td></tr>
            {!! $errors->first('password', '<tr><td colspan="2"><div class="help-block">:message</div></td></tr>') !!}
            <tr>
                <td>
                    {!! Form::label('password', 'Nytt lösenord:') !!}
                </td>
                <td>
                    {!! Form::password('password', ['class' => 'form-input']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    {!! Form::label('password_confirmation', 'Bekräfta lösenord:') !!}
                </td>
                <td>
                    {!! Form::password('password_confirmation', ['class' => 'form-input']) !!}
                </td>
            </tr>
            <tr><td colspan="2"><hr/></td></tr>
        </table>
        {!! Form::submit('Återställ', ['class'=>'btn']) !!}
        {!! Form::close() !!}
    </div>
@stop