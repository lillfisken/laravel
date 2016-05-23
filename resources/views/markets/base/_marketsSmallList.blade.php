<p>
    @if(isset($appendPageName))
        {!! $markets->setPageName(isset($pageName) ? $pageName : 'page')->appends($appendPageName, \Illuminate\Support\Facades\Input::get($appendPageName, 1))->render() !!}
    @else
        {!! $markets->setPageName(isset($pageName) ? $pageName : 'page')->render() !!}
    @endif
</p>
    @if($listType == 'galleryS' || $listType == 'galleryM' || $listType == 'galleryL')
        <div class="flex-container gallery-box-container flex-wrap middle-background ">
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
    @if(isset($appendPageName))
        {!! $markets->setPageName(isset($pageName) ? $pageName : 'page')->appends($appendPageName, \Illuminate\Support\Facades\Input::get($appendPageName, 1))->render() !!}
    @else
        {!! $markets->setPageName(isset($pageName) ? $pageName : 'page')->render() !!}
    @endif
</p>