<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-15
 * Time: 21:50
 */

namespace market\core\market\read;


use Illuminate\Support\Facades\Auth;
use market\core\interfaces\iMarketRead;
use market\models\Market;

class auction extends base implements iMarketRead
{
    public function show($id)
    {
        $auction = Market::withTrashed()->with(['bids.user'])->where('id','=',$id)->first();

        // If auction exist and is of type auction
        if($auction != null && $auction->marketType == 4)
        {
            $bidCount = $auction->bids->count();
            if($bidCount > 0)
            {
                $auction->bidHighest = $auction->bids->sortByDesc('bid')->first()->bid;
            }
            else
            {
                $auction->bidHighest = 0;
            }

            $yourBid = $auction->bids->where('bidder', Auth::id())->first();
            if($yourBid)
            {
                $auction->yourBid = $auction->bids->where('bidder', Auth::id())->first()->bid;
            }
            else
            {
                $auction->yourBid = 0;
            }

            //TODO: Add market menu ???
//            $this->addMarketMenu($auction);

            $auction->end_at_unix = $auction->end_at->timestamp;

            return $auction;
        }
        else
        {
            abort(404);
        }
    }
}