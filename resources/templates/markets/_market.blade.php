	{!! Form::label('title', 'Rubrik') !!}
	{!! Form::text('title', null , ['class' => "form-input" ] ) !!}
	{!! $errors->first('title', '<span class="help-block">:message</span>') !!}
	<hr />
	
	{!! Form::label('type_buy', 'Köpes') !!}
	{!! Form::radio('type', 'Köpes', array('id'=>'type_buy') ) !!}
	{!! Form::label('type_sell', 'Säljes') !!}
	{!! Form::radio('type', 'Säljes', ['id' => 'type_sell']) !!}
	{!! Form::label('type_giveaway', 'Skänkes') !!}
	{!! Form::radio('type', 'Skänkes', ['id' => 'type_giveaway']) !!}
	{!! Form::label('type_change', 'Bytes') !!}
	{!! Form::radio('type', 'Bytes', ['id' => 'type_change']) !!}
	<br />
	{!! Form::label('price', 'Pris') !!}
	{!! Form::text('price', null , ['class' => 'form-input'] ) !!}
	
	{!! Form::label('extra_price_info', 'Extra info om betalning, frakt etc.') !!}
	{!! Form::textarea('extra_price_info', null , ['class' => 'form-input'] ) !!}
	{!! Form::label('numberOfItems', 'Antal till försälning, önskas köpa etc.') !!}
	{!! Form::text('numberOfItems', '1', ['class' => 'form-input'] ) !!}
	<hr />
	{!! Form::label('description', 'Beskrivning') !!}
	{!! Form::textarea('description', null, ['class' => 'form-input'] ) !!}
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
	Välj hur köparna ska kunna kontakta dig<br />
	{!! Form::label('choice_mail', 'Via mail') !!}
	{!! Form::checkbox('choice_mail', 'mail', true) !!}
	{!! Form::label('choice_forum', 'Via öppna frågor') !!}
	{!! Form::checkbox('choice_forum', 'forum', true) !!}<br />
	<hr />