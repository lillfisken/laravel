@if(isset($market->marketmenu) && !empty($market->marketmenu))
    <nav class="market-menu">
        @if($market->hasEvents)
            <i class="fa fa-flag inline"></i>
        @endif
        @if($market->isWatched)
            <i class="fa fa-star inline"></i>
        @endif
        <ul class="inline clearfix">
            <li>
                <a href="#" style="color: #516177">
                    <i class="fa fa-bars fa-2x fa-fw"></i>
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
