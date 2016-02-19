<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-15
 * Time: 21:11
 */

namespace market\core\market\read;


use market\models\Market;

abstract class base
{
    public function show($id)
    {
        $market = Market::withTrashed()->with(['bids.user'])->where('id','=',$id)->first();

        return $market;
    }
}