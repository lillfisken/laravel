@extends('markets.base.show')

@section('priceInfo')
    <h2 id="higestBid"
        class="market-title">{{ preg_replace('/(\.000*)/', '', $market->bidHighest > 0 ? $market->bidHighest : $market->price) }}
        :-</h2>
    <h4>{{ $marketCommon->getMarketTypeName($market->marketType) }}</h4>
    @if($market->deleted_at != null)
        <h3>Avslutad</h3>
        <p>
            Avslutad: {{ $market->deleted_at }}<br/>
            <a href="{{ route('auction.bids', ['markets'=>$market->id]) }}"> Antal bud: {{ $market->bids->count() }} (detaljer)</a><br>
            Högsta bud: {{ preg_replace('/(\.000*)/', '', $market->bidHighest) }}:- <br/>
            Utropspris: {{ preg_replace('/(\.000*)/', '', $market->price) }}:- <br/>
            {{ $market->getEndReasonName() }}
        </p>
    @else
        Utropspris: {{ preg_replace('/(\.000*)/', '',$market->price) }}:- <br/>
        <a href="{{ route('auction.bids', ['markets'=>$market->id]) }}">
            Högsta bud: {{ preg_replace('/(\.000*)/', '', $market->bidHighest) }}:- (detaljer)
        </a><br/>
        <a href="{{ route('auction.bids', ['markets'=>$market->id]) }}">
            Antal budgivare: {{ $market->bidCount }} (detaljer)
        </a><br>
        Slutar: <span id="auction-end"
                      data-unix="{{ $market->end_at_unix }}"
                      data-url="{{ route('api.getAuctionEndTime', [$market->id]) }}">
                    {{ $time->parseTimeAndDateFromUnixToString($market->end_at->timestamp) }}
                </span>
        {{--        Slutar: {{ $time->parseTimeAndDateFromUnixToString($market->end_at) }}--}}
        <hr/>
        @if(isset($preview) && $preview == true)
            <h4>Förhandsgranskning</h4>
        @elseif(\Illuminate\Support\Facades\Auth::check())
            @if($market->createdByUser != \Illuminate\Support\Facades\Auth::id())
                {!! Form::open(array('route' => 'auction.placeBid')) !!}
                {!! Form::hidden('id', $market->id) !!}
                {!! $errors->first('bid', '<div class="help-block">:message</div>') !!}
                {!! Form::text('bid', null , ['class' => "form-input" ] ) !!}
                @if($market->yourBid == 0)
                    {!! Form::submit('Lägg bud', array('class' => 'btn btn80', 'name'=>'placeBid')) !!}
                @else
                    {!! Form::submit('Uppdatera bud', array('class' => 'btn btn80', 'name'=>'placeBid')) !!}<br/>
                    Ditt nuvarande bud:   {{ $market->yourBid or 'null' }}:-<br/><br/>
                @endif
                {!! Form::close() !!}
                <small>
                    Observera att lagt bud är bindande och kan inte ändras.<br/>
                    Sluttiden förlängs automatiskt med 10 min vid bud närmre sluttiden än 10 min.
                </small>
                <hr/>
            @else
                <p>
                    Du kan inte lägga bud på din egna annons
                </p>
            @endif
        @else
            <a href="{!! Route('accounts.login') !!}" class="btn btn80">Logga in för att lägga ett bud </a>
        @endif
    @endif
@endsection