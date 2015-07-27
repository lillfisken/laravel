<div class="market-list-rows-option">
    @include('markets.base._marketmenu')
</div>

<a href="{{ route('auction.show', $market->id) }}" class="market-list-container">
    <div class="market-list-rows-image">
        <img src="{{ $market->image1_thumb }}" />
    </div>

    <div class="market-list-rows-seller">
        <p>
            {{ $market->user->username or 'Unable to get username'}}<br/>
        </p>
        <p>
            {{ $market->user->city or ''}}
        </p>
    </div>

    <div class="market-list-rows-price">
        <h3>Högsta bud eller 0:-</h3>
        <h4>{{ market\helper\markets\MarketBase::getMarketTypeName($market->marketType) }}</h4>
        <hr/>
        <p>
            Utropspris: {{ preg_replace('/(\.000*)/', ':-', $market->price) }}<br/>
            Antal bud: {{ $market->bids->count() }}<br/>
            Slutar: {{ $market->end_at }}

        </p>
        @if(isset($market->deleted_at))
            <h3>Avslutad {{ $market->deleted_at }}</h3>
            <p>
                Högsta bud:
            </p>
        @endif
    </div>

    <div class="market-list-rows-desc">
        <h3><small>SA:</small> {{ str_limit($market->title , 30) }}</h3>
        {!! str_limit($market->description, 500) !!}
    </div>
</a>

{{-- Not using sections because of problem with sections/show/overwrite in multiple includes --}}
