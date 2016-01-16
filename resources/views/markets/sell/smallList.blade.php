<div class="list-row">
    <div class="market-list-rows-option">
        @include('markets.base._marketmenu')
    </div>

    <a href="{{ route('sell.show', $market->id) }}" class="market-list-container">
        <div class="market-list-rows-image">
            <img src="{{ $market->image1_thumb }}"/>
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
            <h3>{{ preg_replace('/(\.000*)/', ':-', $market->price) }}</h3>
            <h4>{{ $marketCommon->getMarketTypeName($market->marketType) }}</h4>
            @if(isset($market->deleted_at))
                <div>Avslutad {{ $market->deleted_at }}</div>
            @endif
        </div>

        <div class="market-list-rows-desc">
            <h3>{{ str_limit($market->title , 30) }}</h3>
{{--            {!! str_limit($market->description, 500) !!}--}}
        </div>
    </a>
    <div>
        @if(isset($market->events))
            @foreach($market->events as $event)
                <p>{{ $event->updated_at }}: {{ $event->message }}</p>
            @endforeach
        @endif
    </div>
</div>
{{-- Not using sections because of problem with sections/show/overwrite in multiple includes --}}
		