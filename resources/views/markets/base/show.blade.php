@extends('layout.site')

@section('title')
    {{ $market->title or 'Titel saknas' }}
@stop

@section('content')
    <div class="inner-content flex-box" xmlns="http://www.w3.org/1999/html">
        <div class="clearfix">
            @section('formStart')
                {!! Form::open(['method' => 'post']) !!}
                    @include('markets.partials._buttons')
                {!! Form::close() !!}
            @show
        </div>
        <div id="events" class="clearfix">
            {{--@if($market->eventsForUser->count() > 0)--}}
                {{--@foreach($market->eventsForUser->first()->events as $event)--}}
                    {{--<div class="stripe">--}}
                        {{--{{ $event->updated_at }},--}}
                        {{--{{ $event->message }},--}}
                    {{--<br/></div>--}}
                {{--@endforeach--}}
            {{--@endif--}}
            @if($market->userUnreadEvents->count() > 0)
                @foreach($market->userUnreadEvents as $unreadEvent)
                    <div class="stripe flex-row">
                        <div class="flex-item">
                            {{ $unreadEvent->event->created_at }}, {{ $unreadEvent->event->body }}
                        </div>
                        <div class="flex-item">
                            @if($unreadEvent->read != null)
                                Läst {{ $unreadEvent->read }}
                            @else
                                <b>Nytt</b>
                            @endif
                        </div>
                        <br/>
                    </div>
                @endforeach
                <hr/>
            @endif
        </div>

        <div id="market-left" class="layout">
            <div id="market-detail" class="layout">
                <div class="market-title">
                    <h1 class="marketmenu-title"> {{ $market->title }} </h1>
                    <div class="marketmenu-right"> @include('markets.base._marketmenu') </div>
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
                    {!! nl2br($market->description)!!}
                </p>


            </div>

            {{--TODO:If säljaren valt öppna frågor--}}
            @include('markets.partials._questionlist')
            {{--endif--}}

        </div>

        <div id="market-right" class="layout">

            <div id="market-price-info" class="layout">
                @section('priceInfo')
                    <h2  class="market-title">{!! preg_replace('/(\.000*)/', ':-', $market->price) !!}</h2>
                    <h4>{{ $marketCommon->getMarketTypeName($market->marketType) }}</h4>
                    @if($market->deleted_at != null)
                        <p>
                            Avslutad: {{ $market->deleted_at }}<br/>
                            Anledning: {{ $market->getEndReasonName() }}
                        </p>
                    @else
                        <p>
                            {{ $market->number_of_items }} st till försäljning<br />
                        </p>
                    @endif
                @show

                @if(isset($market->extra_price_info) && $market->extra_price_info != '')
                    <hr/>
                    <h3>Övrig info</h3>
                    <p>
                        {{ $market->extra_price_info }}
                    </p>
                @endif
                <p>
                    <small>
                        Inlagd {{ $market->created_at }}
                        @if($market->created_at !== $market->updated_at)
                            <br/>Senast uppdaterad {{ $market->updated_at }}
                        @endif
                    </small>
                </p>
                <hr/>
                <p>
                    <a href="{{ Route('market.events', $market->id) }}"> {{ $market->events->count() }}
                        @if( $market->events->count() == 1 )
                            händelse
                        @else
                            händelser
                        @endif</a> <br/>
                    TODO: Versioner
                </p>
            </div>

            <div id="market-seller-info" class="layout">
                <a href="{{ Route('accounts.profile', $market->user->username) }}">
                    <h2  class="market-title" >{{ $market->user->username or 'null'}}
                        <small>(4,8) {{-- Omdömme --}}</small>
                    </h2>
                </a>
                <p>
                    {{ $market->user->getUserActiveMarketsCount() }} aktiva annonser<br />
                    {{ $market->user->getUserTotalMarketsCount() }} tidigare annonser		<br/>
                    {{--Omdöme 4,9 ({{ $market->user->getUserTotalMarketsCount() }} omdömen) <- Not implemented yet <br />--}}
                </p>
                @if(\Illuminate\Support\Facades\Auth::check())
                    <p>
                        @if($market->contactPm)
                            {{-- If market is set to use pm --}}
                            <a href="{{ Route('markets.pm', [$market->user->username, $market->title]) }}" class="btn btn80">
                                Skicka pm
                            </a> <br/>
                        @endif
                        @if($market->contactMail)
                            {{-- If market is set to use pm --}}
                            <a href="{{ Route('message.mail', ['reciever' => $market->user->username, 'title' => $market->title]) }}" class="btn btn80">
                                Skicka mail
                            </a><br/>
                        @endif
                        @if($market->contactPhone && isset($market->user->phone1) && $market->user->phone1 !== '')
                            {{-- If market is set to use pm --}}
                            <a href="{{ 'tel:' . $market->user->phone1 }}" class="btn btn80">Ring säljaren ({{ $market->user->phone1 }})</a>
                        @endif
                    </p>
                @else
                    <p>
                        <a href="{!! Route('accounts.login') !!}" class="btn btn80">Logga in för att kontakta säljaren </a>
                    </p>
                @endif

            </div>

{{--            @include('markets.partials._events')--}}
        </div>

        <div class="clearfix">
            @section('formStop')
                {!! Form::open(['method' => 'post']) !!}
                    @include('markets.partials._buttons')
                {!! Form::close() !!}
            @show
        </div>
    </div>
@stop