@if(isset($markets))
    <?php $count = 1; ?>
    @foreach($markets as $market)

        <div class="market-list-row2 @if($count == 1)row-dark <?php $count = 0; ?> @else	<?php $count = 1; ?> @endif">
            <div class="market-list-rows-option">
                @include('partials._marketmenu')
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
@else
    <h3>Inga annonser att visa</h3>
@endif