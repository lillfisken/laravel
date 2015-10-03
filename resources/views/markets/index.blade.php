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

                @foreach($marketCommon->getAllMarketTypes() as $key => $val)
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

	@include('markets.base._marketsSmallList')
	
@stop
