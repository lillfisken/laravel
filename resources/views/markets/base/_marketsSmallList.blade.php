<p>
    {!! $markets->render() !!}
</p>
    @if($listType == 'galleryS' || $listType == 'galleryM' || $listType == 'galleryL')
        <div class="gallery-box-container">
    @endif
    @foreach($markets as $market)
         @if($market->marketType == 0 /*Sell*/)
            @include('markets.sell.' . $listType)
        @elseif($market->marketType == 1 /*Buy*/)
            @include('markets.buy.' . $listType)
        @elseif($market->marketType == 2 /*Change*/)
            @include('markets.change.' . $listType)
        @elseif($market->marketType == 3 /*Giveaway*/)
            @include('markets.giveaway.' . $listType)
        @elseif($market->marketType == 4 /*Auction*/)
            @include('markets.auction.' . $listType)
        @endif
     @endforeach
    @if($listType == 'galleryS' || $listType == 'galleryM' || $listType == 'galleryL')
        </div>
    @endif
<p>
    {!! $markets->render() !!}
</p>