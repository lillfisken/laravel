	<ul class="menu-row">
		<a href="{{ route('markets.index') }}"><li class="menu-item">Alla annonser</li></a>

		@if(Auth::check())
			<a href="{{ route('accounts.profile', @Auth::user()->username ) }}"><li class="menu-item">{{ Auth::user()->username ?: 'null' }} </li></a>
            <a href="{{ route('message.inbox') }}"><li class="menu-item">PM</li></a>
            <a href="{{ route('message.new') }}"><li class="menu-item">Nytt PM</li></a>
            <a href="{{ route('markets.create') }}"><li class="menu-item">Skapa annons</li></a>
            <a href="{{ route('accounts.settings.settings') }}"><li class="menu-item">Inställningar</li></a>
            <a href="{{ route('accounts.logout') }}"><li class="menu-item"> Logga ut</li></a>
			@if(Config::get('app.debug') === 'true')
			  	<a href="/market/public/index.php/roadmap"><li class="menu-item">Roadmap</li></a>
				<a href="/market/public/index.php/dev"><li class="menu-item">Dev</li> </a>
			@endif
   		@else
            <a href="{{ route('accounts.login') }}"><li class="menu-item">Logga in</li></a>
   		@endif

        <li class="menu-item">
            {!! Form::open(array('route' => 'markets.search', 'method' => 'GET' )) !!}
                {!! Form::text('s', null , ['class' => '{{--form-input--}} inline'] ) !!}
                {!! Form::submit('Sök', ['class' => '{{--btn-right--}} inline']); !!}
            {!! Form::close() !!}
        </li>

	</ul>