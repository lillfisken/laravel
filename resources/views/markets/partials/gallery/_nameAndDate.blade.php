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