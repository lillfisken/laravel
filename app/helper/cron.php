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
        //TODO: delete old php connect
    }

    public function deleteOldTempImages()
    {
        //TODO: delete old temp images
        //Older than 24 hours
    }

    public function endOldAuctions()
    {
        $deleted = \market\Market::where('marketType', 4)
            ->where('end_at', '<', $this->time->getTimeUnix())
//            ->where('deleted_at', null)
            ->delete();

        if($deleted > 0)
        {
            Log::info('cron -> end old auctions. Deleted: ' . $deleted);
        }
    }
}