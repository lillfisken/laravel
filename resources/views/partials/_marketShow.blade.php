<div id="market-left" class="layout">
    <div id="market-detail" class="layout">
        <div class="market-title">
            <h1 class="marketmenu-title"> {{ $market->title }} </h1>
            <div class="marketmenu-right"> @include('partials._marketmenu') </div>
        </div>

        <div class="market-detail-images">
            <div class="okg">
                <ul>
                    @if(isset($market->image1_std))
                        <li><img src="{{ $market->image1_thumb }}" alt="" data-large="{{ $market->image1_std }}" data-full="{{ $market->image1_full }}"></li>
                    @endif
                    @if(isset($market->image2_std))
                        <li><img src="{{ $market->image2_thumb }}" alt="" data-large="{{ $market->image2_std }}" data-full="{{ $market->image2_full }}"></li>
                    @endif
                    @if(isset($market->image3_std))
                        <li><img src="{{ $market->image3_thumb }}" alt="" data-large="{{ $market->image3_std }}" data-full="{{ $market->image3_full }}"></li>
                    @endif
                    @if(isset($market->image4_std))
                        <li><img src="{{ $market->image4_thumb }}" alt="" data-large="{{ $market->image4_std }}" data-full="{{ $market->image4_full }}"></li>
                    @endif
                    @if(isset($market->image5_std))
                        <li><img src="{{ $market->image5_thumb }}" alt="" data-large="{{ $market->image5_std }}" data-full="{{ $market->image5_full }}"></li>
                    @endif
                    @if(isset($market->image6_std))
                        <li><img src="{{ $market->image6_thumb }}" alt="" data-large="{{ $market->image6_std }}" data-full="{{ $market->image6_full }}"></li>
                    @endif
                </ul>
            </div>
        </div>

        <h1>Beskrivning</h1>
        <p>
            {!! $market->description or 'Beskrivning saknas' !!}
        </p>


    </div>

    {{--TODO:If säljaren valt öppna frågor--}}
        @include('partials._questionlist')
    {{--endif--}}

</div>

<div id="market-right" class="layout">
    <div id="market-price-info" class="layout">
        <h2  class="market-title">Pris</h2>
        <h4>{{ market\helper\marketType::getTypeName($market->marketType) }}</h4>
        <h2>{!! $market->price !!} Sek</h2>
        @if($market->deleted_at != null)
            <h3>
                Avslutad<br/>
                <small>{{ market\helper\marketEndReason::getTypeName($market->endReason) }},
                        {{ $market->deleted_at }}</small>
            </h3>
        @else
            <p>
                {{ $market->number_of_items }} st till försäljning<br />
            </p>
        @endif

        <p>
            Inlagd {{ $market->created_at }}
        </p>

        @if(isset($market->extra_price_info) && $market->extra_price_info != ''){{--TODO: Check if there is any extra info, else hide this part--}}
            <h3>Extra info</h3>
            <p>
                {{ $market->extra_price_info }}
            </p>
        @endif
    </div>

    <div id="market-seller-info" class="layout">
        <h2  class="market-title" >Säljare</h2>
        <h3>{{ $market->user->username or 'null'}}</h3>
        <p>
            {{ $market->user->getUserActiveMarketsCount() }} aktiva annonser<br />
            {{ $market->user->getUserTotalMarketsCount() }} tidigare annonser		<br/>
            {{--Omdöme 4,9 ({{ $market->user->getUserTotalMarketsCount() }} omdömen) <- Not implemented yet <br />--}}
        </p>
        <hr/>
        @if(\Illuminate\Support\Facades\Auth::check())
            <p>
                {{--IF MARKET IS SET TO USE PM--}}
                <a href="{{ Route('markets.pm', [$market->user->username, $market->title]) }}" class="btn"> Skicka pm </a> <br/>
                Skicka mail <- Not implemented yet <br/>
                Ring <- Not implemented yet <br/>
            </p>
        @else
            <p>
                <a href="{!! Route('accounts.login') !!}">Logga</a>  in för att kontakta säljaren
            </p>
        @endif

    </div>
    <hr />
</div>