@extends('layout.site')

@section('title')
    Byt lösenord - {{ $user->username }}

@stop

@section('menu2')
    @include('account.settings.menu')
@endsection

@section('content')
    {!! Form::open(['route' => 'accounts.settings.passwordPost']) !!}
    <table class="table-100">
        <colgroup>
            <col width="auto"/>
            <col width="100%"/>
        </colgroup>
        <tr>
            <td colspan="2">
                <h3>Lösenord</h3>
            </td>
        </tr>
        {!! $errors->first('pswdOld', '<tr><td colspan="2"><div class="help-block">:message</div></td></tr>') !!}
        @if(Session::get('pswdOld'))
            <tr><td colspan="2"><div class="help-block">{!! Session::get('pswdOld') !!}</div></td></tr>
        @endif
        <tr>
            <td>
                {!! Form::label('pswdOld', 'Gammalt lösenord') !!}
            </td>
            <td>
                {!! Form::password('pswdOld', ['class' => 'form-input']) !!}
            </td>
        </tr>
        {!! $errors->first('password', '<tr><td colspan="2"><div class="help-block">:message</div></td></tr>') !!}
        <tr>
            <td>
                {!! Form::label('password', 'Nytt lösenord: ') !!}
            </td>
            <td>
                {!! Form::password('password', ['class' => 'form-input']) !!}
            </td>
        </tr>
        <tr>
            <td>
                {!! Form::label('password_confirmation', 'Upprepa lösenord: ') !!}
            </td>
            <td>
                {!! Form::password('password_confirmation', ['class' => 'form-input']) !!}
            </td>
        </tr>
        <tr><td colspan="2"><hr/></td></tr>
    </table>
    {!! Form::submit('Spara', ['class'=>'btn']) !!}
    {!! Form::close() !!}
@stop