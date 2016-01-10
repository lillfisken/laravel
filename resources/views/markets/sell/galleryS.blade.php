<div class="gallery-box-item-s">

    <div class="flex-row">
        <h4 class="flex-left">
            <a href="{{ route('sell.show', $market->id) }}" class="market-list-container">
                {{ str_limit($market->title , 30) }}
            </a>
        </h4>
        <div class="flex-right">
            @include('markets.base._marketmenu')
        </div>
    </div>
    <hr/>
    <div class="flex-row">
        <img src="{{ $market->image1_thumb }}"/>
    </div>

    <a href="{{ route('sell.show', $market->id) }}" class="">
        <div class="">
                    <h5>{{ $marketCommon->getMarketTypeName($market->marketType) }}</h5>
                    <h4>{{ preg_replace('/(\.000*)/', ':-', $market->price) }}</h4>
                    @if(isset($market->deleted_at))
                        <div>Avslutad {{ $market->deleted_at }}</div>
                    @endif
                    <p>
                        {{ $market->user->username }}<br/>
                    </p>
        </div>
    </a>

</div>
