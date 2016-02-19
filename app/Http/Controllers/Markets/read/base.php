<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-15
 * Time: 23:29
 */

namespace market\Http\Controllers\Markets\read;


use market\core\interfaces\iMarketRead;
use market\core\market\marketPrepare;
use market\core\market\marketType;

trait base
{
    public function baseShow($id, iMarketRead $marketRead, marketPrepare $marketPrepare, marketType $marketType)
    {
        $market = $marketRead->show($id);

        if($market != null)
        {
            $marketPrepare->addStuffSingle($market);

            return view('markets.' . $market->routeBase .'.show', [
                'market'=>$market,
                'marketCommon' => $marketType,
            ]);
        }
        abort(404);
    }
}