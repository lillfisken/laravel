<a href="{{ route($market->routeBase . '.show', $market->id) }}" class="flex-row">
    <div class="flex-item padding-right">
        @include('markets.partials.gallery._nameAndDate')
    </div>
    <div class="flex-item">
        <h2>{{ preg_replace('/(\.000*)/', ':-', $market->price) }}</h2>
    </div>
</a>