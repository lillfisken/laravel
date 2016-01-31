@extends('account._partials._layout')

@section('title')
    Inställningar - {{ $user->username }}
@stop

@section('content')
    @include('partials.errors.basic')
    {!! Form::model($user, ['route' => 'accounts.settings.save']) !!}
    <table class="table-100">
        @include('account._partials._profileForm')
    </table>
    {!! Form::submit('Spara', ['class'=>'btn']) !!}
    {!! Form::close() !!}
@stop