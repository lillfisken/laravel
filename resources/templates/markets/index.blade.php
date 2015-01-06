<!-- /var/www/lara/resources/views/markets/index.blade.php -->

@extends('/layout/site')

@section('title')
	Visa annonser
@stop

@section('content')

	<!-- ---------------------------------------------------------------------------- -->
	<!-- Menu-->

	<div class="market-list-menu">
		{!! Form::open(array('url' => 'foo/bar')) !!}
		
		     Säljes {!! Form::checkbox('name', 'saljes', true); !!}
		     Köpes {!! Form::checkbox('name', 'kopes', true); !!}
		     Bytes {!! Form::checkbox('name', 'bytes', true); !!}
		     Skänkes {!! Form::checkbox('name', 'skankes', true); !!}
		     Samköp {!! Form::checkbox('name', 'samkop', true); !!}
		     Tjänst erbjudes {!! Form::checkbox('name', 'tjanst_erbjudes', true); !!}
		     Tjänst sökes {!! Form::checkbox('name', 'tjanst_sökes', true); !!}
		     Anställning {!! Form::checkbox('name', 'anstallning', true); !!}
		     Tips {!! Form::checkbox('name', 'tips', true); !!}
			<hr />
			Visa avslutade annonser {!! Form::checkbox('name', 'ended', false); !!}
			Visa dolda annonser {!! Form::checkbox('name', 'hiddenAds', false); !!}
			Visa annonser från dolda säljare {!! Form::checkbox('name', 'hiddenSellers', false); !!}
		     {!! Form::submit('Uppdatera', array('class' => 'btn-right')); !!}
			
		{!! Form::close() !!}
	</div>
	
	<!-- ---------------------------------------------------------------------------- -->
	<!-- Market listings, list -->
	<?php $count = 1; ?>
	
	@foreach($markets as $market)
		
		<div class="market-list-row2 @if($count == 1)row-dark <?php $count = 0; ?> @else	<?php $count = 1; ?> @endif">
			<div class="market-list-rows-option">
				@include('markets._marketmenu')
			</div>
					
			<a href="{{ route('markets.show', $market->id) }}" class="market-list-container">
				<div class="market-list-rows-image">
					<img src="{{ $market->image1_thumb }}" />
				</div>
						
				<div class="market-list-rows-seller">
					<p>
						{{ $market->user->username or ''}}<br/>
					</p>
					<p>
						{{ $market->user->city or ''}}
					</p>
				</div>
							
				<div class="market-list-rows-price">
					<h3>{{ $market->price }} sek</h3><br/>
					<!--Buy now 2345:--->
				</div>
							
				<div class="market-list-rows-desc">
					<h3>{{ str_limit($market->title, 30) }}</h3><br/>
					{!! str_limit($market->description, 500) !!}
				</div>
			</a>
		</div>
		
	@endforeach
	
@stop
