<!-- /var/www/lara/resources/views/markets/show.blade.php -->

@extends('layout/site')

@section('title')
	{{ $market->title }}
@stop

@section('content')
		
<div id="market-left" class="layout">
	<div id="market-detail" class="layout">
		<div class="market-title">
			<h1 class="marketmenu-title"> {{ $market->title }} </h1>
			<div class="marketmenu-right"> @include('markets._marketmenu') </div>
		</div>

		<div class="market-detail-images">
			@if(isset($market->image1_std))
				<img class="market-detail-big-image"  src="{{ $market->image1_std }}" id="bigImage" />
			@endif
			<div class="market-detail-small-images">
				@if(isset($market->image1_thumb))
					<img class="market-detail-small-image"  src="{{ $market->image1_thumb }}"
					onclick="ChangeImage('{{ $market->image1_std }}','bigImage')" />
				@endif
				@if(isset($market->image2_thumb))
					<img class="market-detail-small-image"  src="{{ $market->image2_thumb }}"
					onclick="ChangeImage('{{ $market->image2_std }}','bigImage')" />
				@endif
				@if(isset($market->image3_thumb))
					<img class="market-detail-small-image"  src="{{ $market->image3_thumb }}"
					onclick="ChangeImage('{{ $market->image3_std }}','bigImage')" />
				@endif
				@if(isset($market->image4_thumb))
					<img class="market-detail-small-image"  src="{{ $market->image4_thumb }}"
					onclick="ChangeImage('{{ $market->image4_std }}','bigImage')" />
				@endif
				@if(isset($market->image5_thumb))
					<img class="market-detail-small-image"  src="{{ $market->image5_thumb }}"
					onclick="ChangeImage('{{ $market->image5_std }}','bigImage')" />
				@endif
				@if(isset($market->image6_thumb))
					<img class="market-detail-small-image"  src="{{ $market->image6_thumb }}"
					onclick="ChangeImage('{{ $market->image6_std }}','bigImage')" />
				@endif
			</div>
		</div>
		
		<p>
			<h1>Beskrivning</h1>
		
			{!! $market->description or 'Beskrivning saknas' !!}
		</p>
	</div>
				
	<div id="market-forum" class="layout">
		<h1 class="market-title" >Frågor</h1>
		<p>
			Diskussion om annonsen, öpnnafrågor om säljaren valt att ha det, förvalt.
		</p>
	</div>
	
</div>
			
<div id="market-right" class="layout">
	<div id="market-price-info" class="layout">
		<h2  class="market-title">Pris</h2>
		<h2>{!! $market->price !!} Sek</h2>
		<br />
		{{ $market->number_of_items }} st till försäljning<br />
		<br />
		Inlagd {{ $market->created_at }}
	</div>
	
	<div id="market-seller-info" class="layout">
		<h2  class="market-title" >Säljare</h2>
		{{ $market->user->username or 'null'}}<br />
		{{ $market->user->getUserActiveMarketsCount() }} aktiva annonser<br />
		{{ $market->user->getUserTotalMarketsCount() }} tidigare annonser <- Not implemented yet<br />
		Omdöme 4,9 (2364) <- Not implemented yet <br />
		<br />
		Skicka pm <- Not implemented yet
	</div>
	<hr />
</div>

@stop