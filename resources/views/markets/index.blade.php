<!-- /var/www/lara/resources/views/markets/index.blade.php -->

@extends('/layout/site')

@section('title')
	Visa annonser
@stop

@section('content')

	<!-- ---------------------------------------------------------------------------- -->
	<!-- Menu-->

	<div class="market-list-menu">
		{!! Form::open(array('route' => 'markets.filter', 'method' => 'get')) !!}
			<ul class="menu-row">

                @foreach($types = market\helper\market::getAllMarketTypes() as $key => $val)
                    <li class="menu-item">
                        {!! Form::label('t' . $key, $val) !!} {!! Form::checkbox('t' . $key , 1,  true); !!}
                    </li>
                @endforeach

                <div class="hr"></div>

				<li class="menu-item">
					{!! Form::label('ended', 'Visa avslutade annonser') !!} {!! Form::checkbox('ended', 1, false); !!}
				</li>
				@if(Auth::check())
					<li class="menu-item">
						{!! Form::label('hiddenAds', 'Visa dolda annonser') !!} {!! Form::checkbox('hiddenAds', 1, false); !!}
					</li>
					<li class="menu-item">
						{!! Form::label('hiddenSellers', 'Visa annonser från dolda säljare') !!} {!! Form::checkbox('hiddenSellers', 1, false); !!}
					</li>
				@endif
				<li class="menu-item">
				{!! Form::submit('Uppdatera', array('class' => 'btnSmall')); !!}
				</li>
			</ul>
		{!! Form::close() !!}
	</div>


	
	<!-- ---------------------------------------------------------------------------- -->
	<!-- Market listings, list -->

	@foreach($markets as $market)

        <div class="list-row">
            @if($market->marketType == 0 /*Sell*/)
                @include('markets.sell.smallList')
            @elseif($market->marketType == 1 /*Buy*/)
                @include('markets.buy.smallList')
            @elseif($market->marketType == 2 /*Giveaway*/)
                @include('markets.giveaway.smallList')
            @elseif($market->marketType == 3 /*Change*/)
                @include('markets.change.smallList')
            @elseif($market->marketType == 4 /*Auction*/)
                @include('markets.auction.smallList')
            @else
                Missing market type {{ $market->marketType }}
            @endif
        </div>

	@endforeach
	
@stop
