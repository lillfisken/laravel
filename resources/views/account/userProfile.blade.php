@extends('account._partials._layout')

@section('title')
    {{ $user->username }}
@stop

@section('content')
    <div class="inner-content">
        <h1>
            {{ $user->username }}
        </h1>
        <h3>Presentation</h3>
        <p>
            {!! $user->presentation !!}
        </p>
        @if($user->cityAllowed)
            <p>
                Ort: {{ $user->city }}
            </p>
        @endif

        <h3>Omdömen</h3>
        <p>
            Här kommer du senare kunna se omdömen från andra om säljaren samt även kunna lämnna ditt egna omdöme efter
            en förhoppningsvis lyckad affär.
        </p>
        @if(! empty($phpBBs))
            <h3>Användaren på andra forum</h3>
            <p>
                @foreach($phpBBs as $phpBB)
                    <a href="{{ $phpBB['url'] }}">{{ $phpBB['forumName'] }}: {{ $phpBB['username'] }}</a><br/>
                @endforeach
            </p>
        @endif
        <h3>Kontakt</h3>
        <p>
            <a href="{{ Route('markets.pm', [$user->username,
                    'Meddelande från ' . \Illuminate\Support\Facades\Auth::user()->username]) }}" class="btn">
                Skicka pm
            </a>
            @if($user->emailAllowed)
                <a href="{{ Route('message.mail', ['reciever' => $user->username,
                    'title' => 'Mail från ' . \Illuminate\Support\Facades\Auth::user()->username]) }}" class="btn">
                    Skicka mail
                </a>
            @endif
            @if($user->phoneAllowed && isset($market->user->phone1) && $market->user->phone1 !== '')
            <a href="{{ 'tel:' . $user->phone1 }}" class="btn ">Ring {{ $user->username }}, ({{ $user->phone1 }})</a>
            @endif
        </p>
        <p>
        Senaste inloggning: ???
        </p>

        <hr/>
        <div class="flex-row">
            <div class="flex-item">
                <h2>{{ $marketsName }}</h2>
            </div>
            <div class="flex-item">
                @include('markets.base._listType')
            </div>
        </div>
        <p>
            <a href="{{ route('accounts.profile', ['user' => $user->username, 'markets' => 'active']) }}">Aktiva annonser</a> |
            <a href="{{ route('accounts.profile', ['user' => $user->username, 'markets' => 'ended']) }}">Avslutade annonser</a>
        </p>
        @include('markets.base._marketsSmallList', ['markets' => $markets])

    </div>
@stop
