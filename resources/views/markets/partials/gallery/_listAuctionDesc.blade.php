<a href="{{ route($market->routeBase . '.show', $market->id) }}" class="flex-row">
    <div class="flex-item padding-right">
        @include('markets.partials.gallery._nameAndDate')
    </div>
    <div class="flex-item padding-right">
        Utropspris: {{ preg_replace('/(\.000*)/', ':-', $market->price) }}<br/>
        Antal bud: {{ $market->bids->count() }}<br/>
        Slutar: {{ $time->parseTimeAndDateFromUnixToString($market->end_at->timestamp) }}
    </div>
    <div class="flex-item">
        <h2>
            @if(isset($market->bidHighest))
                Högsta bud: {{ preg_replace('/(\.000*)/', '', $market->bidHighest) }}:-
            @else
                Utrop: {{ preg_replace('/(\.000*)/', ':-', $market->price) }}
            @endif
        </h2>
        <br/> (Utrop + vinnande bud)
    </div>
</a>