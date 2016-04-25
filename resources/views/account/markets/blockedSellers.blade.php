@extends('account._partials._layout')

@section('title')
    Blockerade säljare - @Auth::user()->username
@stop

@section('content')
    <div class="inner-content">
        <h1>Blockerade säljare</h1>
        <p>
            {!! $blockedUsers->render() !!}
        </p>
        <table class="table-100">
            @foreach($blockedUsers as $blockedUser)
                <tr class="list-row">
                    <td>
                        <a href="{{ route('accounts.profile', $blockedUser->blockedUser->username) }}">
                            <h4>
                                {{ $blockedUser->blockedUser->username }}
                            </h4>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('accounts.unblockSeller', $blockedUser->blockedUser->id) }}" class="btn">Häv blockering</a>
                    </td>
                </tr>
            @endforeach
        </table>
        <p>
            {!! $blockedUsers->render() !!}
        </p>
        <hr/>
        <div class="flex-row">
            <div class="flex-left">
                <h1>Annonser från blockerade säljare</h1>
            </div>
            <div class="flex-right">
                @include('markets.base._listType')
            </div>
        </div>
        @include('markets.base._marketsSmallList')

    </div>
@stop