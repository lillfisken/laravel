<div class="gallery-box-item-m">

    <div class="flex-row">
        <h3 class="flex-left">
            <a href="{{ route('buy.show', $market->id) }}" class="market-list-container">
                {{ str_limit($market->title , 30) }}
            </a>
        </h3>
        <div class="flex-right">
            @include('markets.base._marketmenu')
        </div>
    </div>

    <a href="{{ route('buy.show', $market->id) }}" class="">
        <div class="flex-row">
            <div class="flex-left">
                <div class="">
                    <h3>{{ preg_replace('/(\.000*)/', ':-', $market->price) }}</h3>
                    <h4>{{ $marketCommon->getMarketTypeName($market->marketType) }}</h4>
                    @if(isset($market->deleted_at))
                        <div>Avslutad {{ $market->deleted_at }}</div>
                    @endif
                </div>
                <div class="">
                    <p>
                        {{ $market->user->username or 'Unable to get username'}}<br/>
                    </p>
                    <p>
                        {{ $market->user->city or ''}}
                    </p>
                </div>
            </div>
            <img src="{{ $market->image1_thumb }}" class="flex-right"/>
        </div>

    </a>

</div>
