<div class="flex-row">
    <div class="flex-item gallery-title">
        <h4 class="flex-item">
            <a href="{{ route($market->routeBase . '.show', $market->id) }}" class="">
                {{ $market->title }}
            </a>
        </h4>
    </div>
    <div class="flex-item">
        @include('markets.base._marketmenu')
    </div>
</div>
<hr/>




