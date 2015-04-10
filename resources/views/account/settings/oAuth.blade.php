@extends('layout.site')

@section('title')
    Inställningar - {{ $user->username }}

@stop

@section('content')
    {!! Form::model($user, ['route' => 'accounts.save']) !!}
    <table class="table-100">
        <colgroup>
            <col width="auto"/>
            <col width="100%"/>
        </colgroup>
        <tr>
            <td colspan="2"><h3>Externa kopplingar</h3></td>
        </tr>
        <tr>
            <td>
                Elektronikforumet
            </td>
        </tr>
        <tr>
            <td>
                Google
            </td>
        </tr>
        <tr>
            <td>
                Facebook
            </td>
        </tr>
        <tr>
            <td>
                Twitter
            </td>
        </tr>
        <tr><td colspan="2"><hr/></td></tr>
    </table>
    {!! Form::submit('Spara', ['class'=>'btn']) !!}
    {!! Form::close() !!}
@stop