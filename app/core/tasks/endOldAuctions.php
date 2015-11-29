<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-11-29
 * Time: 22:42
 */

namespace market\core\tasks;


use Illuminate\Support\Facades\Log;
use market\helper\time;

class endOldAuctions
{
    public function __construct()
    {

    }

    public function end()
    {
        Log::debug('endOldAuctions->end');
        $time = new time();
        $deleted = \market\models\Market::where('marketType', 4)
            ->where('end_at', '<', $time->getTimeUnix())
//            ->where('deleted_at', null)
            ->delete();

        if($deleted > 0)
        {
            Log::info('cron -> end old auctions. Deleted: ' . $deleted);
        }
    }
}