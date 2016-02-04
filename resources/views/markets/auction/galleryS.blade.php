<div class="gallery-box-item-s">

    @include('markets.partials.gallery._galleryS_image_title_menu')

        <div class="flex-row">
                {{--<div class="">--}}

                    {{--<h5>{{ $marketCommon->getMarketTypeName($market->marketType) }}</h5>--}}
                    {{--@if(isset($market->deleted_at))--}}
                        {{--<div>Avslutad {{ $market->deleted_at }}</div>--}}
                    {{--@endif--}}
                {{--</div>--}}
                {{--<div class="">--}}
                    {{--<p>--}}
                        {{--{{ $market->user->username or 'Unable to get username'}}<br/>--}}
                    {{--</p>--}}
                {{--</div>--}}
            @include('markets.partials.gallery._auctionDesc')
        </div>

</div>
