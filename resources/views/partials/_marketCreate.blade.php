	<h3>{!! Form::label('title', 'Rubrik') !!}</h3>
	{!! Form::text('title', null , ['class' => "form-input" ] ) !!}
	{!! $errors->first('title', '<span class="help-block">:message</span>') !!}
	<hr />
    <h3>{!! Form::label('type', 'Annonstyp') !!}</h3>
    {!! Form::select('marketType', market\helper\marketType::getTypesMarket(), null,  ['class' => 'form-input'] ) !!}
    {{-- DELETE THIS AFTER CHANGING DB AND ALL OTHER METHODS --}}
	{{--{!! Form::select('type', market\helper\marketType->getTypesMarket() ) !!}--}}
	{{--{!! Form::label('type_buy', 'Köpes') !!}--}}
	{{--{!! Form::radio('type', 'Köpes', array('id'=>'type_1buy') ) !!}--}}
	{{--{!! Form::label('type_sell', 'Säljes') !!}--}}
	{{--{!! Form::radio('type', 'Säljes', ['id' => 'type_sell']) !!}--}}
	{{--{!! Form::label('type_giveaway', 'Skänkes') !!}--}}
	{{--{!! Form::radio('type', 'Skänkes', ['id' => 'type_giveaway']) !!}--}}
	{{--{!! Form::label('type_change', 'Bytes') !!}--}}
	{{--{!! Form::radio('type', 'Bytes', ['id' => 'type_change']) !!}--}}

	<hr />
	<h3>{!! Form::label('description', 'Beskrivning') !!}</h3>
	{!! Form::textarea('description', null, ['class' => 'form-input'] ) !!}
	<hr />
	<h3>{!! Form::label('price', 'Pris') !!}</h3>
	{!! Form::text('price', null , ['class' => 'form-input'] ) !!}

	<h3>{!! Form::label('extra_price_info', 'Extra info om betalning, frakt etc.') !!}</h3>
	{!! Form::textarea('extra_price_info', null , ['class' => 'form-input'] ) !!}
	<h3>{!! Form::label('numberOfItems', 'Antal') !!}</h3>
	{!! Form::text('numberOfItems', '1', ['class' => 'form-input'] ) !!}
	<hr />
	@if(isset($market->image1_thumb))
		<img class="market-detail-small-image"  src="{{ $market->image1_thumb }}"/>
	@endif
	{!! Form::label('image1','Bild 1',array('id'=>'','class'=>'')) !!}
  	{!! Form::file('image1','',array('id'=>'','class'=>'')) !!} Huvudbild <br />
  	@if(isset($market->image1_thumb))
		<img class="market-detail-small-image"  src="{{ $market->image2_thumb }}"/>
	@endif
  	{!! Form::label('image2','Bild 2',array('id'=>'','class'=>'')) !!}
  	{!! Form::file('image2','',array('id'=>'','class'=>'')) !!}<br />
  	@if(isset($market->image1_thumb))
		<img class="market-detail-small-image"  src="{{ $market->image3_thumb }}"/>
	@endif
  	{!! Form::label('image3','Bild 3',array('id'=>'','class'=>'')) !!}
  	{!! Form::file('image3','',array('id'=>'','class'=>'')) !!}<br />
  	@if(isset($market->image1_thumb))
		<img class="market-detail-small-image"  src="{{ $market->image4_thumb }}"/>
	@endif
  	{!! Form::label('image4','Bild 4',array('id'=>'','class'=>'')) !!}
  	{!! Form::file('image4','',array('id'=>'','class'=>'')) !!}<br />
  	@if(isset($market->image1_thumb))
		<img class="market-detail-small-image"  src="{{ $market->image5_thumb }}"/>
	@endif
  	{!! Form::label('image5','Bild 5',array('id'=>'','class'=>'')) !!}
  	{!! Form::file('image5','',array('id'=>'','class'=>'')) !!}<br />
  	@if(isset($market->image1_thumb))
		<img class="market-detail-small-image"  src="{{ $market->image6_thumb }}"/>
	@endif
  	{!! Form::label('image6','Bild 6',array('id'=>'','class'=>'')) !!}
  	{!! Form::file('image6','',array('id'=>'','class'=>'')) !!}<br />
	<hr />
	<h3>Välj hur köparna ska kunna kontakta dig</h3>
    {!! Form::label('contactPm', 'PM') !!}
    {!! Form::checkbox('contactPm', 'pm', true) !!}
	{!! Form::label('contactMail', 'Mail') !!}
	{!! Form::checkbox('contactMail', 'mail', true) !!}
    {!! Form::label('contactPhone', 'Telefon') !!}
    {!! Form::checkbox('contactPhone', 'phone', true) !!}
	{!! Form::label('contactQuestion', 'Via öppna frågor') !!}
	{!! Form::checkbox('contactQuestion', 'forum', true) !!}<br />
	<hr />