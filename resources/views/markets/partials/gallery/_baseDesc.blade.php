<a href="{{ route($market->routeBase . '.show', $market->id) }}" class="">
    <div class="">
        <h5>{{ $marketCommon->getMarketTypeName($market->marketType) }}</h5>
        <h4>{{ preg_replace('/(\.000*)/', ':-', $market->price) }}</h4>
        @if(isset($market->deleted_at))
            <div>Avslutad {{ $market->deleted_at }}</div>
        @endif
        <p>
            {{ $market->user->username }}<br/>
        </p>
    </div>
</a>