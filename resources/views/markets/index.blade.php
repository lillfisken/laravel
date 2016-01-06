<!-- /var/www/lara/resources/views/markets/index.blade.php -->

@extends('/layout/site')

@section('title')
    Visa annonser
    @stop

    @section('content')

            <!-- ---------------------------------------------------------------------------- -->
    <!-- Menu-->

    <div class="market-list-menu">
        {!! Form::open(array('route' => 'markets.filter', 'method' => 'get')) !!}
        <ul class="menu-row">
            <li class="menu-item">
                <i class="fa fa-th-list fa-lg fa-fw"></i>
                <i class="fa fa-th-large fa-lg fa-fw"></i>
                <i class="fa fa-th fa-lg fa-fw"></i>
            </li>
            <hr/>
            @foreach($marketCommon->getAllMarketTypes() as $key => $val)
                <li class="menu-item">
                    {!! Form::label('t' . $key, $val) !!} {!! Form::checkbox('t' . $key , 1,  true) !!}
                </li>
            @endforeach
            <div class="hr"></div>

            <li class="menu-item">
                {!! Form::label('ended', 'Visa avslutade annonser') !!} {!! Form::checkbox('ended', 1, false) !!}
            </li>
            @if(Auth::check())
                <li class="menu-item">
                    {!! Form::label('hiddenAds', 'Visa dolda annonser') !!} {!! Form::checkbox('hiddenAds', 1, false) !!}
                </li>
                <li class="menu-item">
                    {!! Form::label('hiddenSellers', 'Visa annonser från dolda säljare') !!} {!! Form::checkbox('hiddenSellers', 1, false) !!}
                </li>
            @endif
            <li class="menu-item">
                <button type="submit" class="btnSmall"><i class="fa fa-refresh"></i></button>
            </li>
        </ul>
        <div style="text-align: right">

        </div>
        {!! Form::close() !!}
    </div>

    <!-- ---------------------------------------------------------------------------- -->
    <!-- Market listings, list -->

    @include('markets.base._marketsSmallList')

@stop
