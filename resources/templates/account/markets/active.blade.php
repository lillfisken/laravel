@extends('account/_layout')

@section('title')

@stop

@section('content')
    <h3>Aktiva</h3>
    <?php $count = 1; ?>
    @foreach($markets as $market)

        <div class="market-list-row2 @if($count == 1)row-dark <?php $count = 0; ?> @else	<?php $count = 1; ?> @endif">
            <div class="market-list-rows-option">
                <div>
                    <a href="{{route('markets.edit', $market->id) }}" class="button"> Redigera </a>
                </div>
                <div>
                    <a href="{{route('markets.delete', $market->id) }}" class="button"> Avsluta </a>
                </div>
            </div>

            <a href="{{ route('markets.show', $market->id) }}" class="market-list-container">
                <div class="market-list-rows-image">
                    <img src="{{ $market->image1_thumb }}" />
                </div>

                <div class="market-list-rows-price">
                    <h3>{{ $market->price }} sek</h3><br/>
                    <!--Buy now 2345:--->
                </div>

                <div class="market-list-rows-desc">
                    <h3>{{ str_limit($market->title , 30) }}</h3><br/>
                    {!! str_limit($market->description, 500) !!}
                </div>
            </a>
        </div>

    @endforeach
@stop