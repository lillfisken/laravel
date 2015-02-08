<ul class="menu-row">
    <a href="{{ route('accounts.watched', @Auth::user()->username) }}"><li class="menu-item">Bevakade</li></a>
    <a href="{{ route('accounts.active', @Auth::user()->username) }}"><li class="menu-item">Aktiva</li></a>
    <a href="{{ route('accounts.trashed', @Auth::user()->username) }}"><li class="menu-item">Avslutade</li></a>
    <a href="{{ route('accounts.blockedmarket', @Auth::user()->username) }}"><li class="menu-item">Blockerade annonser</li></a>
    <a href="{{ route('accounts.blockedseller', @Auth::user()->username) }}"><li class="menu-item">Blockerade säljare</li></a>

    <a href="{{ route('accounts.inbox', @Auth::user()->username) }}"><li class="menu-item">Inkorg</li></a>
    <a href="{{ route('accounts.draft', @Auth::user()->username) }}"><li class="menu-item">Utkast</li></a>
    <a href="{{ route('accounts.sent', @Auth::user()->username) }}"><li class="menu-item">Skickat</li></a>
    <a href="{{ route('accounts.trash', @Auth::user()->username) }}"><li class="menu-item">Papperskorg</li></a>
    <a href="{{ route('accounts.settings', @Auth::user()->username) }}"><li class="menu-item menu-last">Inställningar</li></a>
</ul>