	<h3>{!! Form::label('title', 'Rubrik') !!}</h3>
	{!! Form::text('title', null , ['class' => "form-input" ] ) !!}
	{!! $errors->first('title', '<span class="help-block">:message</span>') !!}
	<hr />
    <h3>{!! Form::label('type', 'Annonstyp') !!}</h3>
    {!! Form::select('marketType', market\helper\marketType::getTypesMarket(), null,  ['class' => 'form-input'] ) !!}

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
        {!! Form::hidden('image1_thumb', $market->image1_thumb) !!}
        {!! Form::hidden('image1_std', $market->image1_std) !!}
        {!! Form::hidden('image1_full', $market->image1_full) !!}
	@endif
	{!! Form::label('image1','Bild 1',array('id'=>'','class'=>'')) !!}
  	{!! Form::file('image1','',array('id'=>'','class'=>'')) !!} Huvudbild <br />
  	@if(isset($market->image2_thumb))
		<img class="market-detail-small-image"  src="{{ $market->image2_thumb }}"/>
        {!! Form::hidden('image2_thumb', $market->image2_thumb) !!}
        {!! Form::hidden('image2_std', $market->image2_std) !!}
        {!! Form::hidden('image2_full', $market->image2_full) !!}
	@endif
  	{!! Form::label('image2','Bild 2',array('id'=>'','class'=>'')) !!}
  	{!! Form::file('image2','',array('id'=>'','class'=>'')) !!}<br />
  	@if(isset($market->image3_thumb))
		<img class="market-detail-small-image"  src="{{ $market->image3_thumb }}"/>
        {!! Form::hidden('image3_thumb', $market->image3_thumb) !!}
        {!! Form::hidden('image3_std', $market->image3_std) !!}
        {!! Form::hidden('image3_full', $market->image3_full) !!}
	@endif
  	{!! Form::label('image3','Bild 3',array('id'=>'','class'=>'')) !!}
  	{!! Form::file('image3','',array('id'=>'','class'=>'')) !!}<br />
  	@if(isset($market->image4_thumb))
		<img class="market-detail-small-image"  src="{{ $market->image4_thumb }}"/>
        {!! Form::hidden('image4_thumb', $market->image4_thumb) !!}
        {!! Form::hidden('image4_std', $market->image4_std) !!}
        {!! Form::hidden('image4_full', $market->image4_full) !!}
	@endif
  	{!! Form::label('image4','Bild 4',array('id'=>'','class'=>'')) !!}
  	{!! Form::file('image4','',array('id'=>'','class'=>'')) !!}<br />
  	@if(isset($market->image5_thumb))
		<img class="market-detail-small-image"  src="{{ $market->image5_thumb }}"/>
        {!! Form::hidden('image5_thumb', $market->image5_thumb) !!}
        {!! Form::hidden('image5_std', $market->image5_std) !!}
        {!! Form::hidden('image5_full', $market->image5_full) !!}
	@endif
  	{!! Form::label('image5','Bild 5',array('id'=>'','class'=>'')) !!}
  	{!! Form::file('image5','',array('id'=>'','class'=>'')) !!}<br />
  	@if(isset($market->image6_thumb))
		<img class="market-detail-small-image"  src="{{ $market->image6_thumb }}"/>
        {!! Form::hidden('image6_thumb', $market->image6_thumb) !!}
        {!! Form::hidden('image6_std', $market->image6_std) !!}
        {!! Form::hidden('image6_full', $market->image_full) !!}
	@endif
  	{!! Form::label('image6','Bild 6',array('id'=>'','class'=>'')) !!}
  	{!! Form::file('image6','',array('id'=>'','class'=>'')) !!}<br />
	<hr />
	<h3>Välj hur köparna ska kunna kontakta dig</h3>
    {!! Form::label('contactPm', 'PM') !!}
    {!! Form::checkbox('contactPm', '1', true) !!}
	{!! Form::label('contactMail', 'Mail') !!}
	{!! Form::checkbox('contactMail', '1', true) !!}
    {!! Form::label('contactPhone', 'Telefon') !!}
    {!! Form::checkbox('contactPhone', '1', true) !!}
	{!! Form::label('contactQuestions', 'Via öppna frågor') !!}
	{!! Form::checkbox('contactQuestions', '1', true) !!}<br />
	<hr />