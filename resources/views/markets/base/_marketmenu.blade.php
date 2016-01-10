@if(isset($market->marketmenu) && !empty($market->marketmenu))
    <nav class="market-menu">
        <ul class="clearfix">
            <li>
                <a href="#" style="color: #516177">
                    <i class="fa fa-bars fa-2x fa-fw"></i>
                    @if(isset($market->watched) && $market->watched == 1)
                        <div class="dot"></div>
                    @endif
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
