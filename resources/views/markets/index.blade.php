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

                @foreach($types = market\helper\marketType::getAllTypes() as $key => $val)
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
	<?php $count = 1; ?>
	
	@foreach($markets as $market)
		
		<div class="list-row @if($count == 1)row-dark <?php $count = 0; ?> @else	<?php $count = 1; ?> @endif">
			<div class="market-list-rows-option">
				@include('markets.partials._marketmenu')
			</div>
					
			<a href="{{ route('markets.show', $market->id) }}" class="market-list-container">
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
					<h3>{{ preg_replace('/(\.000*)/', ':-', $market->price) }}</h3>
					Typ(annons, auktion etc)<br/>
                    <h4>{{ market\helper\marketType::getTypeName($market->marketType) }}</h4>
					{{--Typ (köpes, säljes etc)<br/>--}}
					{{--Antal kommentarer--}}
					@if(isset($market->deleted_at))
						<h3>Avslutad</h3>
					@endif
				</div>
							
				<div class="market-list-rows-desc">
					<h3>{{ str_limit($market->title , 30) }}</h3><br/>
					{!! str_limit($market->description, 500) !!}
				</div>
			</a>
		</div>
		
	@endforeach
	
@stop
