<div class="flex-item">
    <a href="{{ route($market->routeBase . '.show', $market->id) }}" class="">
        <div class="">
            <h4>
                @if(isset($market->bidHighest))
                    Högsta bud: {{ preg_replace('/(\.000*)/', '', $market->bidHighest) }}:-
                @else
                    Utrop: {{ preg_replace('/(\.000*)/', ':-', $market->price) }}
                @endif
            </h4>
            TODO: ENDED<br/>
            Antal bud: ???<br/>
            <hr/>
            <p>
                {{ $market->user->username }}<br/>
                {{ $market->user->city or ''}}<br/>
            </p>
            <hr/>
            <p>
                <small>
                    Inlagd: {{ $market->created_at }}
                    @if(isset($market->deleted_at))
                        <br/>Avslutad: {{ $market->deleted_at }}
                    @endif
                </small>
            </p>
        </div>
    </a>
</div>