<div class="gallery-box-item-list list-row">
    <div class="flex-row">
        <div class="flex-item padding-right">
            @include('markets.partials.gallery._baseImage')
        </div>
        <div class="flex-item width100">
            @include('markets.partials.gallery._baseTitle')
            <div class="flex-row">
                @include('markets.partials.gallery._listAuctionDesc')
            </div>
        </div>
    </div>
</div>
{{-- Not using sections because of problem with sections/show/overwrite in multiple includes --}}





{{--<div class="list-row">--}}
    {{--<div class="market-list-rows-option">--}}
        {{--@include('markets.base._marketmenu')--}}
    {{--</div>--}}

    {{--<a href="{{ route('auction.show', $market->id) }}" class="market-list-container">--}}
        {{--<div class="market-list-rows-image">--}}
            {{--<img src="{{ $market->image1_thumb }}"/>--}}
        {{--</div>--}}

        {{--<div class="market-list-rows-seller">--}}
            {{--<p>--}}
                {{--{{ $market->user->username or 'Unable to get username'}}<br/>--}}
            {{--</p>--}}
            {{--<p>--}}
                {{--{{ $market->user->city or ''}}--}}
            {{--</p>--}}
        {{--</div>--}}
    {{--</a>--}}
{{--</div>--}}
        {{--<div class="market-list-rows-price">--}}
            {{--        <h3>{{ $market->bidHighest }}</h3>--}}
            {{--<h3>@if(isset($market->bidHighest))--}}
                    {{--Bud: {{ preg_replace('/(\.000*)/', '', $market->bidHighest) }}:---}}
                {{--@else--}}
                    {{--{{ preg_replace('/(\.000*)/', ':-', $market->price) }}--}}
                {{--@endif</h3>--}}
            {{--<h4>{{ $marketCommon->getMarketTypeName($market->marketType) }}</h4>--}}
            {{--<hr/>--}}
            {{--<p>--}}
                {{--Utropspris: {{ preg_replace('/(\.000*)/', ':-', $market->price) }}<br/>--}}
                {{--Antal bud: {{ $market->bids->count() }}<br/>--}}
                {{--Slutar: {{ $time->parseTimeAndDateFromUnixToString($market->end_at->timestamp) }}--}}
            {{--</p>--}}
            {{--@if(isset($market->deleted_at))--}}
                {{--<h3>Avslutad {{ $time->parseTimeAndDateFromUnixToString($market->deleted_at->timestamp) }}</h3>--}}
                {{--<h3>--}}
                    {{--@if(isset($market->bidHighest))--}}
                        {{--Vinnande bud: {{ preg_replace('/(\.000*)/', '', $market->bidHighest) }}:---}}
                    {{--@else--}}
                        {{--Inga bud--}}
                    {{--@endif--}}
                {{--</h3>--}}
            {{--@endif--}}
        {{--</div>--}}

        {{--<div class="market-list-rows-desc">--}}
            {{--<h3>--}}
                {{--{{ str_limit($market->title , 30) }}</h3>--}}
{{--            {!! str_limit($market->description, 500) !!}--}}
        {{--</div>--}}
    {{--</a>--}}

    {{--<div>--}}
        {{--@if(isset($market->events))--}}
            {{--@foreach($market->events as $event)--}}
                {{--<p>{{ $event->updated_at }}: {{ $event->message }}</p>--}}
            {{--@endforeach--}}
        {{--@endif--}}
    {{--</div>--}}
{{--</div>--}}
{{-- Not using sections because of problem with sections/show/overwrite in multiple includes --}}
