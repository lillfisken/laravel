<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-12-06
 * Time: 18:13
 */

namespace market\core\bid;


use market\models\Bid;

class getAllBids
{
    public function get($marketId)
    {
        $b = Bid::where('auctionId', $marketId)->get();

        return $b;
    }
}