<label for="show-menu" class="show-menu"><i class="fa fa-bars bars" ></i></label>
<input type="checkbox" id="show-menu" class="menu-bar" role="button">

<ul class="resp-menu">
    <li class="searchTop">
        {!! Form::open(array('route' => 'markets.search', 'method' => 'GET' )) !!}
        {!! Form::text('s', null , ['class' => 'inline'] ) !!}
        {!! Form::submit('Sök', ['class' => 'btnSmall inline']); !!}
        {!! Form::close() !!}
    </li>

    <li><a href="{{ route('markets.index') }}">Alla annonser</a></li>

    @if(Auth::check())
        <li>
            <a href="#">{{ Auth::user()->username ?: 'null' }} </a>
            <ul>
                <li><a href="{{ route('accounts.profile', @Auth::user()->username) }}">Profil</a></li>
                <li><a href="{{ route('accounts.watched', @Auth::user()->username) }}">Bevakade</a></li>
                <li><a href="{{ route('accounts.active', @Auth::user()->username) }}">Aktiva</a></li>
                <li><a href="{{ route('accounts.trashed', @Auth::user()->username) }}">Avslutade</a></li>
                <li><a href="{{ route('accounts.blockedmarket', @Auth::user()->username) }}">Blockerade annonser</a></li>
                <li><a href="{{ route('accounts.blockedseller', @Auth::user()->username) }}">Blockerade säljare</a></li>
            </ul>
        </li>
        <li>
            <a href="#">PM</a>
            <ul>
                <li><a href="{{ route('message.inbox') }}">Inkorg</a></li>
                <li><a href="{{ route('message.new') }}">Nytt PM</a></li>
            </ul>
        </li>

        <li><a href="{{ route('markets.create') }}">Skapa annons</a></li>
        <li>
            <a href="#">Inställningar</a>
            <ul>
                <li><a href="{{ route('accounts.settings.settings') }}">Profil</a></li>
                <li><a href="{{ route('accounts.settings.password') }}">Lösenord</a></li>
                <li><a href="{{ route('accounts.settings.oauth') }}">Externa inloggningar</a></li>
            </ul>
        </li>
        <li><a href="{{ route('accounts.logout') }}">Logga ut</a></li>
        @if(Config::get('app.debug') === 'true')
            <li><a href="/market/public/index.php/roadmap">Roadmap</a></li>
            <li><a href="/market/public/index.php/dev">Dev</a></li>
        @endif
    @else
        <li><a href="{{ route('accounts.login') }}">Logga in</a></li>
    @endif

    <li class="searchBottom">
        {!! Form::open(array('route' => 'markets.search', 'method' => 'GET' )) !!}
            {!! Form::text('s', null , ['class' => 'inline'] ) !!}
            {!! Form::submit('Sök', ['class' => 'btnSmall inline']); !!}
        {!! Form::close() !!}
    </li>

</ul>