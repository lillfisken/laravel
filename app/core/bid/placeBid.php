<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-12-06
 * Time: 18:00
 */

namespace market\core\bid;


use Carbon\Carbon;
use market\models\Bid;
use market\models\Market;

class placeBid
{
    public function place($marketId, $bidderId, $bid)
    {
        //TODO: Check, bid must be higher -> request
        $this->saveBid($marketId, $bidderId, $bid);
        $this->extendMarketEndAt($marketId);
    }

    protected function extendMarketEndAt($marketId)
    {
        //TODO: Move to market??
        $market = Market::where('id', $marketId)->first();
        if($market && $market->end_at->timestamp < time() + 60*10)
        {
            //If auction is due to end at in 10 minutes
            //Extend auction with 10 minutes
            $market->end_at = Carbon::createFromTimestamp($market->end_at->timestamp + 60*10)->format('Y/m/d H:i');
            $market->save();
        }
    }

    protected function saveBid($marketId, $bidderId, $bid)
    {
        $b = Bid::where('bidder', $bidderId)->where('auctionId', $marketId)->first();

        if($b)
        {
            $b->bid = $bid;
        }
        else
        {
            $b = new Bid();
            $b->auctionId = $marketId;
            $b->bidder = $bidderId;
            $b->bid = $bid;
        }

        return $b->save();
    }
}