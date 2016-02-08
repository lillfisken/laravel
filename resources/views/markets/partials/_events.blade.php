{{--@if( $market->watched && $market->watched->unreadEvents )--}}
@if( $market->hasEvent )
    <div id="market-event-info">
        <h2 class="market-title">
            Nya händelser
        </h2>
        <p>
            @foreach ( $market->watched->unreadEvents as $event)
                {{ $event->created_at }}<br/>
                {{ $event->message }}
                <hr/>
            @endforeach
        </p>
    </div>
@endif