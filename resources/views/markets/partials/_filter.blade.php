<div class="flex-container flex-space-between dark-border-bottom">
    <div class="inline flex-grow-30">
        @foreach($marketCommon->getAllMarketTypes() as $key => $val)
            <a href="{{ route('markets.filter', ['t' . $key => '1' ] ) }}"
               class="btn-filter dark-border bg-{{ $marketCommon->getRouteBase($key) }}">
                {{ $val }}
            </a>
        @endforeach
    </div>
    <div class="">
        <div class="inline">
            <input type="checkbox" id="filter-checkbox"/>
            <label for="filter-checkbox" id="filter-open"><i class="fa fa-plus"></i></label>
            <label for="filter-checkbox" id="filter-closed"><i class="fa fa-minus"></i></label>
        </div>
        <div class="inline">
            @include('markets.base._listType')
        </div>
    </div>
</div>
<div id="filter-extended" class="flex-row">
    <div class="">
        {!! Form::open(array('route' => 'markets.filter', 'method' => 'get')) !!}

        <div class="filter-options stripe">
            @foreach($marketCommon->getAllMarketTypes() as $key => $val)
                <span class=" btn-filter bg-{{ $marketCommon->getRouteBase($key) }}">
                {!! Form::label('t' . $key, $val) !!}
                    {!! Form::checkbox('t' . $key , 1,  $urlParam->isTrue('t' . $key)) !!}
            </span>
            @endforeach
        </div>
        <div class="filter-options stripe flex-container flex-space-between">
            {!! Form::label('e', 'Visa avslutade annonser') !!} {!! Form::checkbox('e', 1, $urlParam->isTrue('e') ) !!}
        </div>
        <div class="filter-options stripe flex-container flex-space-between">
            {!! Form::label('oam', 'Dölj pågående annonser') !!} {!! Form::checkbox('oam', 1, $urlParam->isTrue('oam') ) !!}
        </div>
        @if(Auth::check())
            <div class="filter-options stripe flex-container flex-space-between">
                {!! Form::label('hm', 'Visa dolda annonser') !!} {!! Form::checkbox('hm', 1, $urlParam->isTrue('hm') ) !!}
            </div>
            <div class="filter-options stripe flex-container flex-space-between">
                {!! Form::label('hs', 'Visa annonser från dolda säljare') !!} {!! Form::checkbox('hs', 1, $urlParam->isTrue('hs') ) !!}
            </div>
        @endif
        <div class="filter-options stripe flex-container flex-space-between">
            {!! Form::label('st', 'Fritext: ') !!}
            {!! Form::text('st', $urlParam->get('st') , ['placeholder' => 'Fritext']) !!}
        </div>
        <div class="filter-options stripe flex-container flex-space-between">
            {!! Form::label('se', 'Säljare: ') !!}
            {!! Form::text('se', $urlParam->get('se') , ['placeholder' => 'Säljare']) !!}
        </div>
        <div class="filter-options stripe flex-container flex-space-between">
            <div></div>
            <button type="submit" class="btnSmall">Filtrera <i class="fa fa-refresh"></i></button>
        </div>
        {!! Form::close() !!}

        <hr/>
    </div>
</div>
