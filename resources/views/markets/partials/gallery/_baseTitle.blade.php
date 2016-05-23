{{--<div class="flex-container flex-space-between flex-nowrap flex-row">--}}
<div class="flex-container flex-space-between" style="width: 100%">
        <div style="overflow: hidden">
            <a href="{{ route($market->routeBase . '.show', $market->id) }}" class="">
                <h3 class="gallery-title">
                    {{ $market->title }}
                </h3>
                <small>
                {{ $marketCommon->getMarketTypeName($market->marketType) }}
                </small>
            </a>
        </div>
        {{--<div class="flex-item">--}}
                {{--<small>--}}
                    {{--{{ $marketCommon->getMarketTypeName($market->marketType) }}--}}
                {{--</small>--}}
        {{--</div>--}}
        {{--<div>--}}
            @include('markets.base._marketmenu')
        {{--</div>--}}
    </div>
<div class="bg-{{ $market->routeBase }}"></div>



