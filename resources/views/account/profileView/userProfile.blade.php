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
            Här kommer du senare kunna se omdömen från andra om säljaren samt även kunna lämnna ditt egna omdöme efter en förhoppningsvis lyckad affär.
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
            <a href="{{ route('message.new', ['title' => 'hubba']) }}" class="btn">Skicka PM </a>

            @if($user->emailAllowed)
                <a href="{{ route('message.new', ['title' => 'hubba']) }}" class="btn">Skicka e-post </a>
            @endif
            @if($user->phoneAllowed)
                <a href="tel:{{ $user->phone1 }}" class="btn">Ring {{ $user->phone1 }} </a>
            @endif
        </p>
        {{--<p>--}}
            {{--Senaste inloggning: ???--}}
        {{--</p>--}}

        <hr/>

        <h3>Aktiva annonser</h3>
        @include('markets.base._marketsSmallList', ['markets' => $activeMarkets])

        <hr/>

        <h3>Avslutade annonser</h3>
        @include('markets.base._marketsSmallList', ['markets' => $inactiveMarkets])
    </div>
@stop
