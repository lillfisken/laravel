<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-10-04
 * Time: 22:50
 */

namespace market\helper;


use Illuminate\Support\Facades\Log;

class cron {
    public function cleanOldPhpBBConnect()
    {

    }

    public function endOldAuctions()
    {
        $deleted = $auction = \market\Market::where('marketType', 4)
            ->where('endingAt', '<', time())
            ->delete();

        if($deleted > 0)
        {
            Log::debug('cron -> end old auctions. Deleted: ' . $deleted);
        }
    }

    public function cronIsWorking()
    {
        Log::debug('Cron Is Working');
    }
}