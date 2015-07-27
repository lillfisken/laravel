<?php namespace market\helper;

use DateTime;
use Illuminate\Support\Facades\Auth;
use market\Bid as BidEloquent;
use market\Market;

class bid
{
    public static function placeBid($marketId, $userId, $bid)
    {
        //TODO: Check, bid must be higher -> request

        $b = BidEloquent::where('bidder', $userId)->where('auctionId', $marketId)->first();
        $market = Market::where('id', $marketId)->with('bids')->first();
        if($market)
        {
            //Check bid
            if($market->bids->sortByDesc('bid')->first()->bid > $bid)
            {
                //New bid is lower than highest bid
                //TODO: Return proper code with errors to user
                abort(418);
            }

            //Check time
            if(strtotime($market->end_at) < time() + 60*10)
            {
                //If auction is due to end at in 10 minutes
                //Extend auction with 10 minutes

//                dd('2015-07-27 19:17:23',
//                    $market->end_at,
//                    $market->end_at + 60*10,
//                    strtotime($market->end_at),
//                    strtotime($market->end_at) + 60*10,
//                    date('Y-m-d H:i:s', strtotime($market->end_at) + 60*10)
//                );

                $market->end_at = date('Y-m-d H:i:s', strtotime($market->end_at) + 60*10);
                $market->save();
            }
        }
        else
        {
            abort(404, 'Market missing');
        }

        $setter = 'null';
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

        return $b->save();
    }

    protected function getAllBids($marketId)
    {
        $b = BidEloquent::where('auctionId', $marketId);

        return $b;

    }




}