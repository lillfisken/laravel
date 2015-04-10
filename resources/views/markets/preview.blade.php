@extends('layout/site')

@section('title')
    Förhandsgranska {{ $market->title }}
@stop

@section('content')
    <div class="clearfix padding5">
        <h1 class="inline">FÖRHANDSGRANSKA</h1>
        {!! Form::model($market, array('url' => $postBackURL, 'method' => $postBackType)) !!}
        {!! Form::hidden('createdByUser') !!}
        {!! Form::hidden('title') !!}
        {!! Form::hidden('marketType') !!}
        {!! Form::hidden('description') !!}
        {!! Form::hidden('price') !!}
        {!! Form::hidden('extra_price_info') !!}
        {!! Form::hidden('number_of_items') !!}
        @if(isset($market->image1_thumb))
            {!! Form::hidden('image1') !!}
            {!! Form::hidden('image1_thumb') !!}
            {!! Form::hidden('image1_std') !!}
            {!! Form::hidden('image1_full') !!}
        @endif
        @if(isset($market->image2_thumb))
            {!! Form::hidden('image2') !!}
            {!! Form::hidden('image2_thumb') !!}
            {!! Form::hidden('image2_std') !!}
            {!! Form::hidden('image2_full') !!}
        @endif
        @if(isset($market->image3_thumb))
            {!! Form::hidden('image3') !!}
            {!! Form::hidden('image3_thumb') !!}
            {!! Form::hidden('image3_std') !!}
            {!! Form::hidden('image3_full') !!}
        @endif
        @if(isset($market->image4_thumb))
            {!! Form::hidden('image4') !!}
            {!! Form::hidden('image4_thumb') !!}
            {!! Form::hidden('image4_std') !!}
            {!! Form::hidden('image4_full') !!}
        @endif
        @if(isset($market->image5_thumb))
            {!! Form::hidden('image5') !!}
            {!! Form::hidden('image5_thumb') !!}
            {!! Form::hidden('image5_std') !!}
            {!! Form::hidden('image5_full') !!}
        @endif
        @if(isset($market->image6_thumb))
            {!! Form::hidden('image6') !!}
            {!! Form::hidden('image6_thumb') !!}
            {!! Form::hidden('image6_std') !!}
            {!! Form::hidden('image6_full') !!}
        @endif
        {!! Form::hidden('contactPm') !!}
        {!! Form::hidden('contactMail') !!}
        {!! Form::hidden('contactPhone') !!}
        {!! Form::hidden('contactQuestion') !!}
        {!! Form::submit('Publicera', ['name'=>'publishHTML', 'class'=>'btn']) !!}
        {!! Form::submit('Ändra', ['name'=>'edit', 'class'=>'btn']) !!}
        <hr/>
    </div>
    <div class="clearfix">
        @include('partials._marketShow')
    </div>

    <div class="clearfix padding5">
        <hr/>
        <h1>FÖRHANDSGRANSKA</h1>
        {!! Form::submit('Publicera', ['name'=>'publishHTML', 'class'=>'btn']) !!}
        {!! Form::submit('Ändra', ['name'=>'edit', 'class'=>'btn']) !!}
        {!! Form::close() !!}
    </div>
@stop
