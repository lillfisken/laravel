@extends('account._partials._layout')

@section('title')
    {{ $user->username }}
@stop

{{--@if(\Illuminate\Support\Facades\Auth::check())--}}
    {{--@section('menu2')--}}
        {{--@include('account.settings.menu')--}}
    {{--@endsection--}}
{{--@endif--}}

@section('content')
    <div class="inner-content">
        <h1>
            {{ $user->username }}
        </h1>
        <p>
            {!! $user->presentation !!}
        </p>
        <hr/>
        <ul>
            <li>Omdömen</li>
            <li>Användarens annonser</li>
            <li>Senaste inloggning</li>
            <li>PM</li>
            <li>Mail</li>

        </ul>
    </div>

@stop
