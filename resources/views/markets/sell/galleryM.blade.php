<div class="gallery-box-item-m">

    {{--<div class="flex-row">--}}
        {{--<h3 class="flex-item">--}}
            {{--<a href="{{ route($market->routeBase . '.show', $market->id) }}" class="">--}}
                {{--{{ str_limit($market->title , 30) }}--}}
            {{--</a>--}}
        {{--</h3>--}}
        {{--<div class="flex-right">--}}
            {{--@include('markets.base._marketmenu')--}}
        {{--</div>--}}
    {{--</div>--}}

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


    {{--<a href="{{ route($market->routeBase . '.show', $market->id) }}" class="">--}}
        {{--<div class="flex-row">--}}
            {{--<div class="flex-left">--}}
                {{--<div class="">--}}
                    {{--<h3>@if(isset($market->bidHighest))--}}
                            {{--Bud: {{ preg_replace('/(\.000*)/', '', $market->bidHighest) }}:---}}
                        {{--@else--}}
                            {{--{{ preg_replace('/(\.000*)/', ':-', $market->price) }}--}}
                        {{--@endif</h3>--}}
                    {{--<h4>{{ $marketCommon->getMarketTypeName($market->marketType) }}</h4>--}}
                    {{--@if(isset($market->deleted_at))--}}
                        {{--<div>Avslutad {{ $market->deleted_at }}</div>--}}
                    {{--@endif--}}
                {{--</div>--}}
                {{--<div class="">--}}
                    {{--<p>--}}
                        {{--{{ $market->user->username}}<br/>--}}
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
