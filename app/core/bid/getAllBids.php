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
    protected function get($marketId)
    {
        $b = Bid::where('auctionId', $marketId);

        return $b;
    }
}