<div class="gallery-box-item-m">

    @include('markets.partials.gallery._baseTitle')

    <div class="flex-row">
        <div class="flex-item">
            @include('markets.partials.gallery._baseDesc')
        </div>
        <div class="flex-item">
            <div class="flex-row galleryM-image">
                @include('markets.partials.gallery._baseImage')
            </div>
        </div>
    </div>

    {{--<a href="{{ route('buy.show', $market->id) }}" class="">--}}
        {{--<div class="flex-row">--}}
            {{--<div class="flex-left">--}}
                {{--<div class="">--}}
                    {{--<h3>{{ preg_replace('/(\.000*)/', ':-', $market->price) }}</h3>--}}
                    {{--<h4>{{ $marketCommon->getMarketTypeName($market->marketType) }}</h4>--}}
                    {{--@if(isset($market->deleted_at))--}}
                        {{--<div>Avslutad {{ $market->deleted_at }}</div>--}}
                    {{--@endif--}}
                {{--</div>--}}
                {{--<div class="">--}}
                    {{--<p>--}}
                        {{--{{ $market->user->username or 'Unable to get username'}}<br/>--}}
                    {{--</p>--}}
                    {{--<p>--}}
                        {{--{{ $market->user->city or ''}}--}}
                    {{--</p>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<img src="{{ $market->image1_thumb }}" class="flex-right"/>--}}
        {{--</div>--}}

    {{--</a>--}}

</div>
