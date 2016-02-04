<a href="{{ route($market->routeBase . '.show', $market->id) }}" class="">
    <div class="">
        <h2>{{ preg_replace('/(\.000*)/', ':-', $market->price) }}</h2>
        -----
        @include('markets.partials.gallery._nameAndDate')
    </div>
</a>