<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-01-18
 * Time: 19:02
 */

namespace market\core\market;


use Illuminate\Support\Facades\Auth;
use market\helper\marketMenu;

class marketPrepare
{
    protected $marketCommon;

    public function __construct(marketType $marketType)
    {
        $this->marketCommon = $marketType;
    }
    public function addStuff($markets)
    {
        $auctionHelper = new \market\helper\markets\auction();

        if(Auth::check())
        {
            marketMenu::addMarketMenuToMarkets($markets);
        }

        foreach($markets as $market)
        {
            $auctionHelper->setHighestBid($market);
            $this->marketCommon->setRouteBase($market);
        }
    }

}