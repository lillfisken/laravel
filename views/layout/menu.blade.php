	<ul class="menu-row">
		<a href="{{ route('markets.index') }}"><li class="menu-item">Alla annonser</li></a>

		@if(Auth::check())
		    <li class="menu-item"> Inloggad som {{ Auth::user()->name ?: '' }} </li>
		    <li class="menu-item"> Profil </li>
		    <a href="{{ route('markets.create') }}"><li class="menu-item">Skapa annons</li></a>
   		    <a href="{{ route('accounts.logout') }}"><li class="menu-item"> Logga ut</li></a>
   		    <a href="/market/public/index.php/roadmap"><li class="menu-item">Roadmap</li></a>
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