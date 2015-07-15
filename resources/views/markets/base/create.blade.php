@extends('layout.site')

@section('title')
    {{ $title }}
@stop

@section('content')
    <div class="inner-content">
        @section('market-title')
            <h1>{{ $model->title or $title }}</h1>
        @show
        <hr />

        @section('formOpen')
            {!! Form::model($model, array('route' => $callbackRoute , 'files' => true )) !!}
        @show

            {!! Form::hidden('marketType', $marketType) !!}

            <h3>{!! Form::label('title', 'Rubrik') !!}</h3>
            {!! $errors->first('title', '<div class="help-block">:message</div>') !!}
            {!! Form::text('title', null , ['class' => "form-input" ] ) !!}
            <hr />
            <h3>{!! Form::label('description', 'Beskrivning') !!}</h3>
            {!! $errors->first('description', '<div class="help-block">:message</div>') !!}
            {!! Form::textarea('description', null, ['class' => 'form-input okgbb'] ) !!}
            <hr />
            @section('market-price-settings')
                <h3>{!! Form::label('price', 'Pris') !!}</h3>
                {!! $errors->first('price', '<div class="help-block">:message</div>') !!}
                {!! Form::text('price', null , ['class' => 'form-input'] ) !!}
            @show
            <h3>{!! Form::label('extra_price_info', 'Extra info om betalning, frakt etc.') !!}</h3>
            {!! Form::textarea('extra_price_info', null , ['class' => 'form-input okgbb'] ) !!}

            @section('numberOfItemsForSale')
            <h3>{!! Form::label('number_of_items', 'Antal') !!}</h3>
                @if(isset($market->number_of_items))
                    {!! Form::text('number_of_items', null, ['class' => 'form-input'] ) !!}
                @else
                    {!! Form::text('number_of_items', '1', ['class' => 'form-input'] ) !!}
                @endif
            @show

            <hr />
            @if(isset($model->image1_thumb))
                <img class="market-detail-small-image"  src="{{ $model->image1_thumb }}"/>
                {!! Form::hidden('image1_thumb', $model->image1_thumb) !!}
                {!! Form::hidden('image1_std', $model->image1_std) !!}
                {!! Form::hidden('image1_full', $model->image1_full) !!}
            @endif
            {!! Form::label('image1','Bild 1',array('id'=>'','class'=>'')) !!}
            {!! Form::file('image1','',array('id'=>'','class'=>'')) !!} Huvudbild <br />
            @if(isset($model->image2_thumb))
                <img class="market-detail-small-image"  src="{{ $model->image2_thumb }}"/>
                {!! Form::hidden('image2_thumb', $model->image2_thumb) !!}
                {!! Form::hidden('image2_std', $model->image2_std) !!}
                {!! Form::hidden('image2_full', $model->image2_full) !!}
            @endif
            {!! Form::label('image2','Bild 2',array('id'=>'','class'=>'')) !!}
            {!! Form::file('image2','',array('id'=>'','class'=>'')) !!}<br />
            @if(isset($model->image3_thumb))
                <img class="market-detail-small-image"  src="{{ $model->image3_thumb }}"/>
                {!! Form::hidden('image3_thumb', $model->image3_thumb) !!}
                {!! Form::hidden('image3_std', $model->image3_std) !!}
                {!! Form::hidden('image3_full', $model->image3_full) !!}
            @endif
            {!! Form::label('image3','Bild 3',array('id'=>'','class'=>'')) !!}
            {!! Form::file('image3','',array('id'=>'','class'=>'')) !!}<br />
            @if(isset($model->image4_thumb))
                <img class="market-detail-small-image"  src="{{ $model->image4_thumb }}"/>
                {!! Form::hidden('image4_thumb', $model->image4_thumb) !!}
                {!! Form::hidden('image4_std', $model->image4_std) !!}
                {!! Form::hidden('image4_full', $model->image4_full) !!}
            @endif
            {!! Form::label('image4','Bild 4',array('id'=>'','class'=>'')) !!}
            {!! Form::file('image4','',array('id'=>'','class'=>'')) !!}<br />
            @if(isset($model->image5_thumb))
                <img class="market-detail-small-image"  src="{{ $model->image5_thumb }}"/>
                {!! Form::hidden('image5_thumb', $model->image5_thumb) !!}
                {!! Form::hidden('image5_std', $model->image5_std) !!}
                {!! Form::hidden('image5_full', $model->image5_full) !!}
            @endif
            {!! Form::label('image5','Bild 5',array('id'=>'','class'=>'')) !!}
            {!! Form::file('image5','',array('id'=>'','class'=>'')) !!}<br />
            @if(isset($model->image6_thumb))
                <img class="market-detail-small-image"  src="{{ $model->image6_thumb }}"/>
                {!! Form::hidden('image6_thumb', $model->image6_thumb) !!}
                {!! Form::hidden('image6_std', $model->image6_std) !!}
                {!! Form::hidden('image6_full', $model->image_full) !!}
            @endif
            {!! Form::label('image6','Bild 6',array('id'=>'','class'=>'')) !!}
            {!! Form::file('image6','',array('id'=>'','class'=>'')) !!}<br />
            <hr />

            @section('contact')
                <h3>Välj hur köparna ska kunna kontakta dig</h3>
                {!! $errors->first('contactPm', '<div class="help-block">:message</div>') !!}
                {!! $errors->first('contactMail', '<div class="help-block">:message</div>') !!}
                {!! $errors->first('contactPhone', '<div class="help-block">:message</div>') !!}
                {!! $errors->first('contactQuestions', '<div class="help-block">:message</div>') !!}

                {!! Form::label('contactPm', 'PM') !!}
                {!! Form::checkbox('contactPm', '1', true) !!}
                {!! Form::label('contactMail', 'Mail') !!}
                {!! Form::checkbox('contactMail', '1', true) !!}
                {!! Form::label('contactPhone', 'Telefon') !!}
                {!! Form::checkbox('contactPhone', '1', true) !!}
                {!! Form::label('contactQuestions', 'Via öppna frågor') !!}
                {!! Form::checkbox('contactQuestions', '1', true) !!}<br />
                <hr />
            @show

            @section('formStop')
                @if(isset($buttons))
                    @foreach($buttons as $button)
                        {!! Form::submit($button['title'], array('class' => 'btn', 'name'=>$button['name'])); !!}
                    @endforeach
                @endif
                {!! Form::close() !!}
            @show
    </div>

@stop