@extends('layout.site')

{{--@if(\Illuminate\Support\Facades\Auth::check())--}}
    @section('menu2')
        @include('account._partials._menu')
    @endsection
{{--@endif--}}