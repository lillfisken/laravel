@extends('markets.base.show')

@section('priceInfo')
    <h2 id="higestBid" class="market-title">{{ preg_replace('/(\.000*)/', '', $bidHighest > 0 ? $bidHighest : $market->price) }}:-</h2>
    <h4>{{ market\helper\market::getMarketTypeName($market->marketType) }}</h4>
    @if($market->deleted_at != null)
        <h3>
            Avslutad<br/>
            <small>{{ market\helper\market::getEndReasonName($market->endReason) }},
                {{ $market->deleted_at }}</small>
        </h3>
            <p>
                Antal bud, utropspris och vinnande bud och länk till historik
            </p>
    @else
        Utropspris: {{ preg_replace('/(\.000*)/', '',$market->price) }}:- <br/>
        Högsta bud: {{ preg_replace('/(\.000*)/', '', $bidHighest) }}:- <br/>
        <a href="{{ route('auction.bids', ['markets'=>$market->id]) }}">Antal budgivare: {{ $bidCount }}</a><br>
        Slutar: {{ $market->end_at }}
        <hr/>
        @if(isset($preview) && $preview == true)
            <h4>Förhandsgranskning</h4>
        @elseif(\Illuminate\Support\Facades\Auth::check())
            {!! Form::open(array('route' => 'auction.placeBid')) !!}
                {!! Form::hidden('id', $market->id) !!}
                {!! $errors->first('bid', '<div class="help-block">:message</div>') !!}
                {!! Form::text('bid', null , ['class' => "form-input" ] ) !!}
                @if($yourBid == 0)
                    {!! Form::submit('Lägg bud', array('class' => 'btn btn80', 'name'=>'placeBid')); !!}
                @else
                    {!! Form::submit('Uppdatera bud', array('class' => 'btn btn80', 'name'=>'placeBid')); !!}<br/>
                    Ditt nuvarande bud:   {{ $yourBid or 'null' }}:-<br/><br/>
                @endif
                    {!! Form::close() !!}
            <small>Observera att lagt bud är bindande och kan inte ändras.</small>
            <hr/>
        @else
            <a href="{!! Route('accounts.login') !!}" class="btn btn80">Logga in för att lägga ett bud </a>
        @endif
    @endif

    @if(isset($market->extra_price_info) && $market->extra_price_info != '')
        <hr/>
        <h3>Övrig info</h3>
        <p>
            {{ $market->extra_price_info }}
        </p>
    @endif

    <p>
        <small>
            Inlagd {{ $market->created_at }}<br/>
            @if($market->created_at != $market->updated_at)
                <br/>Senast uppdaterad {{ $market->updated_at }}
            @endif
        </small>
    </p>
@endsection