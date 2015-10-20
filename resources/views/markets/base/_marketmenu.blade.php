@if(isset($market->marketmenu) && !empty($market->marketmenu))
    <nav class="market-menu">
        <ul class="clearfix">
            <li>
                {{--TODO: Change to font awesome--}}
                <a href="#">
                    <div class="btn-menu">
                        @if(isset($market->watched) && $market->watched == 1)
                            <div class="dot"></div>
                        @endif
                        <div class="menu-bar"></div>
                        <div class="menu-bar"></div>
                        <div class="menu-bar"></div>
                    </div>
                </a>

                <ul class="market-sub-menu">
                    @foreach($market->marketmenu as $marketmenuitem)
                        <li><a href={{ $marketmenuitem['href'] }}>{{ $marketmenuitem['text'] }}</a></li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </nav>
@endif
