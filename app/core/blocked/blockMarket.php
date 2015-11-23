<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-11-21
 * Time: 18:59
 */

namespace market\core\blocked;


use market\models\blockedMarket;

class blockMarket
{
    public function block($blockerUserId, $blockedMarketId)
    {
        if($blockerUserId > 0 && $blockedMarketId > 0)
        {
            $blocked = new blockedMarket([
                'marketId' => $blockedMarketId,
                'userId' => $blockerUserId
            ]);

            return $blocked->save();
        }

        abort(404);
    }
}