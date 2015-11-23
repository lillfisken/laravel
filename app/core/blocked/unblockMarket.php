<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-11-21
 * Time: 19:00
 */

namespace market\core\blocked;


use market\models\blockedMarket;

class unblockMarket
{
    public function unblock($userId, $marketId)
    {
//        dd('unvblock');
        $market = blockedMarket::where('userId', $userId)
            ->where('marketId', $marketId)
            ->first();

        if($market != null)
        {
            return $market->delete();
        }
        abort(404);
    }
}