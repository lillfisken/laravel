<div class="flex-row">
    <div class="flex-item width100">
        <div class="flex-row width90">
            <div class="flex-item">
                @foreach($marketCommon->getAllMarketTypes() as $key => $val)
                    <a href="{{ route('markets.filter', ['t' . $key => '1' ] ) }}"
                       class="btn bg-{{ $marketCommon->getRouteBase($key) }}">
                        {{ $val }}
                    </a>
                @endforeach
            </div>
            <div class="flex-item">
                <input type="checkbox" id="filter-checkbox" />
                <label for="filter-checkbox" id="filter-open"><i class="fa fa-plus"></i></label>
                <label for="filter-checkbox" id="filter-closed"><i class="fa fa-minus"></i></label>
            </div>
        </div>
    </div>
    <div class="flex-item">
        @include('markets.base._listType')
    </div>
</div>
<hr/>
<div id="filter-extended" class="flex-row">
    <div class="flex-item width100">
        {!! Form::open(array('route' => 'markets.filter', 'method' => 'get')) !!}

        @foreach($marketCommon->getAllMarketTypes() as $key => $val)
            <span class="bg-{{ $marketCommon->getRouteBase($key) }}">
                {!! Form::label('t' . $key, $val) !!}
                {!! Form::checkbox('t' . $key , 1,  $urlParam->isTrue('t' . $key)) !!}
            </span>
        @endforeach
        <br/>

        {!! Form::label('e', 'Visa avslutade annonser') !!} {!! Form::checkbox('e', 1, $urlParam->isTrue('e') ) !!}
        <br/>

        @if(Auth::check())
            {!! Form::label('hm', 'Visa dolda annonser') !!} {!! Form::checkbox('hm', 1, $urlParam->isTrue('hm') ) !!}
            {!! Form::label('hs', 'Visa annonser från dolda säljare') !!} {!! Form::checkbox('hs', 1, $urlParam->isTrue('hs') ) !!}
        @endif
        <br/>

        {!! Form::label('st', 'Fritext: ') !!}
        {!! Form::text('st', $urlParam->get('st') , ['placeholder' => 'Fritext']) !!}
        <br/>

        {!! Form::label('se', 'Säljare: ') !!}
        {!! Form::text('se', $urlParam->get('se') , ['placeholder' => 'Säljare']) !!}
        <br/>

        <button type="submit" class="btnSmall"><i class="fa fa-refresh"></i></button>

        {!! Form::close() !!}

        <hr/>
    </div>
</div>
