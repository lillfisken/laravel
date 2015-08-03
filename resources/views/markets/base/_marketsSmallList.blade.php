<p>
    Paginering << < 1 2 3 |4| 5 6 7 > >>
    {{--{!! $markets->render() !!}--}}
</p>

@foreach($markets as $market)

    <div class="list-row">
        @if($market->marketType == 0 /*Sell*/)
            {{--<hr/>Sell<hr/>--}}
            {{--                <hr/>{{ !($market->bids->count() > 0) }} {{ empty($market->bids) }} {{ $market->bids }} {{ $market->bids->count() }}<hr/>--}}
            @include('markets.sell.smallList')
        @elseif($market->marketType == 1 /*Buy*/)
            {{--<hr/>Buy<hr/>--}}
            {{--                <hr/>{{ !($market->bids->count() > 0) }} {{ empty($market->bids) }} {{ $market->bids }} {{ $market->bids->count() }}<hr/>--}}
            @include('markets.buy.smallList')
        @elseif($market->marketType == 2 /*Change*/)
            {{--<hr/>Giveaway<hr/>--}}
            {{--                <hr/>{{ !($market->bids->count() > 0) }} {{ empty($market->bids) }} {{ $market->bids }} {{ $market->bids->count() }}<hr/>--}}
            @include('markets.change.smallList')
        @elseif($market->marketType == 3 /*Giveaway*/)
            {{--<hr/>Change<hr/>--}}
            {{--                <hr/>{{ ($market->bids->count() >! 0) }} {{ empty($market->bids) }} {{ $market->bids }} {{ $market->bids->count() }}<hr/>--}}
            @include('markets.giveaway.smallList')
        @elseif($market->marketType == 4 /*Auction*/)
            {{--<hr/>Auction<hr/>--}}
            {{--                <hr/>{{ !($market->bids->count() > 0) }} {{ empty($market->bids) }} {{ $market->bids }} {{ $market->bids->count() }}<hr/>--}}
            @include('markets.auction.smallList')
        @else
            Missing market type {{ $market->marketType }}
        @endif
    </div>

@endforeach

<p>
    Paginering << < 1 2 3 |4| 5 6 7 > >>
</p>