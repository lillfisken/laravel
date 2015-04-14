@extends('layout.site')

@section('title')
    Inställningar - {{ $user->username }}

@stop

@section('menu2')
    @include('account.settings.menu')
@endsection

@section('content')
    {!! Form::model($user, ['route' => 'accounts.settings.save']) !!}
    <table class="table-100">
        @include('account._partials._profileForm')
    </table>
    {!! Form::submit('Spara', ['class'=>'btn']) !!}
    {!! Form::close() !!}
@stop