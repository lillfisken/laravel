<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-01-18
 * Time: 19:02
 */

namespace market\core\market;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use market\core\menu\marketMenu as marketMenuCore;

class marketPrepare
{
    protected $marketCommon;
    protected $marketMenu;
//    protected $auction;

    public function __construct(marketType $marketType, marketMenuCore $marketMenu/*, auction $auction*/)
    {
        $this->marketCommon = $marketType;
        $this->marketMenu = $marketMenu;
//        $this->auction = $auction;
    }
    public function addStuff($markets)
    {
//        Log::debug('Core->market->marketPrepare->addStuff');
//        $auctionHelper = new \market\helper\markets\auction();

//        if(Auth::check())
//        {
////            marketMenu::addMarketMenuToMarkets($markets);
//            $this->marketMenu->addMarketMenuToMarkets($markets);
//        }

        foreach($markets as $market)
        {
            $this->addStuffSingle($market);
        }
    }

    public function addStuffSingle($market)
    {
//        Log::debug('Core->market->marketPrepare->addStuffSingle');

        if(Auth::check())
        {
//            marketMenu::addMarketMenuToMarkets($markets);
            $this->marketMenu->addMarketMenu($market);
        }

        //TODO: Watched flags and events
//            dd('marketPrepare', $market, $market->watched->events);
//        $this->auction->setHighestBid($market);
//        $this->auction->setBidCount($market);
//        $this->auction->setYourBid($market);

//            $auctionHelper->setHighestBid($market);
        $this->marketCommon->setRouteBase($market);
    }
}
