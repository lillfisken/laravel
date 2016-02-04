<div class="flex-row bg-{{ $market->routeBase }} space-after width100">
    <div class="flex-item gallery-title">
        <div class="flex-item">
            <h3>
                <a href="{{ route($market->routeBase . '.show', $market->id) }}" class="">
                    {{ $market->title }}
                </a>
            </h3>
            <p>
                <small>
                    {{ $marketCommon->getMarketTypeName($market->marketType) }}
                </small>
            </p>
        </div>
    </div>
    <div class="flex-item">
        @include('markets.base._marketmenu')
    </div>
</div>




