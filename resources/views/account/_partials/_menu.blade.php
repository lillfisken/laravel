<ul class="menu-row">
    <a href="{{ route('accounts.watched', @Auth::user()->username) }}"><li class="menu-item">Bevakade</li></a>
    <a href="{{ route('accounts.active', @Auth::user()->username) }}"><li class="menu-item">Aktiva</li></a>
    <a href="{{ route('accounts.trashed', @Auth::user()->username) }}"><li class="menu-item">Avslutade</li></a>
    <a href="{{ route('accounts.blockedmarket', @Auth::user()->username) }}"><li class="menu-item">Blockerade annonser</li></a>
    <a href="{{ route('accounts.blockedseller', @Auth::user()->username) }}"><li class="menu-item">Blockerade säljare</li></a>

</ul>