<?php namespace market\helper;

use DateTime;
use Illuminate\Support\Facades\Auth;
use market\models\Bid as BidEloquent;
use market\models\Market;

class bid
{
    public static function placeBid($marketId, $userId, $bid)
    {
        //TODO: Check, bid must be higher -> request

        $b = BidEloquent::where('bidder', $userId)->where('auctionId', $marketId)->first();
        $market = Market::where('id', $marketId)->with('bids')->first();
        if($market && strtotime($market->end_at) < time() + 60*10)
        {
            //If auction is due to end at in 10 minutes
            //Extend auction with 10 minutes

            $market->end_at = $market->end_at->timestamp + 60*10;
            $market->save();
        }

        if($b)
        {
            $b->bid = $bid;
        }
        else
        {
            $b = new BidEloquent();
            $b->auctionId = $marketId;
            $b->bidder = $userId;
            $b->bid = $bid;
        }

        return $b->save();
    }

    protected function getAllBids($marketId)
    {
        $b = BidEloquent::where('auctionId', $marketId);

        return $b;
    }
}