@extends('layout/site')

@section('title')
    {{ $user->username }}
@stop

@section('content')

    <h1> {{ $user->username }} </h1>
    <hr/>
    <br/>

    Vänster fält = Meny för användarinteraktion<br/>
    Dela upp nedan på flera olika sidor/delar.
    <br/>
    Ändra uppgifter<br/>
    Ändra lösenord<br/>
    Mina bud<br/>
    Koppla konto mot phpBB, Facebook, google (Openauth)
    Etc.<br/>
    <hr/>
    <br/>
    Höger fält = Aktuell interaktion<br/>
    <br/>
    <hr/>
    <h2>Mina bevakade annonser</h2>
    <p>
        En lista över bevakde annonser
    </p>
    <hr/>
    <h2>Mina annonser</h2>
    <p>
        Lägg till meny för att sortera, visa avslutade annonser, etc
    </p>
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

    <h3>Avslutade</h3>
    <?php $count = 1; ?>
    @foreach($trashed as $market)

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
    <hr/>
    <h2>Mina blockerade annonser</h2>
    <hr/>
    <h2>Mina blockerade säljare</h2>

@stop