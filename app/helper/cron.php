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

    protected $time;

    public function __construct()
    {
        $this->time = new time();
    }

    public function cleanOldPhpBBConnect()
    {

    }

    public function endOldAuctions()
    {
//        Log::debug('cron -> end old auctions');
        $deleted = \market\Market::where('marketType', 4)
            ->where('end_at', '<', $this->time->getTimeUnix())
            ->delete();

//        if($deleted > 0)
//        {
            Log::debug('cron -> end old auctions. Deleted: ' . $deleted);
//        }
    }

    public function cronIsWorking()
    {
        Log::debug('Cron Is Working');
    }
}