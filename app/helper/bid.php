<?php namespace market\helper;

use Illuminate\Support\Facades\Auth;
use market\Bid as BidEloquent;

class bid
{
    public static function placeBid($marketId, $userId, $bid)
    {
        //TODO: Check if user already have a bid, if yes update, if no, add new
        //TODO: Check, bid must be higher -> request

        $b = BidEloquent::where('bidder', $userId)->where('auctionId', $marketId)->first();


        $setter = 'null';
//        dd($b);
        if($b)
        {
            $setter='updating';
            $b->bid = $bid;
        }
        else
        {
            $setter='new';
            $b = new BidEloquent();
            $b->auctionId = $marketId;
            $b->bidder = $userId;
            $b->bid = $bid;
        }

//        dd($setter, $b);

//        dd($b->save());

        return $b->save();
    }

    protected function getAllBids($marketId)
    {
        $b = BidEloquent::where('auctionId', $marketId);

        return $b;

    }




}