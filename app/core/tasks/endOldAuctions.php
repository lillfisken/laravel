<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-11-29
 * Time: 22:42
 */

namespace market\core\tasks;


use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use market\models\Market;

class endOldAuctions
{
    public function __construct()
    {

    }

    public function end()
    {
        $timestamp = Carbon::createFromTimestamp(time());
        Log::debug('core/tasks/endOldAuctions->end()');

        /*
         * Get all market to delete
         * Loop over and delete one by one
         * Log each deletion
         * This preserves eloquent delete
         */

        Market::where('marketType', 4)
            ->where('end_at', '<', $timestamp)
            ->whereNull('deleted_at')
            ->with('bids')
            ->chunk(20, function ($toDelete) {
                foreach ($toDelete as $d) {
                    if ($d->bids->count() > 0) {
                        $d->endReason = 0; //Sold
                        $d->save();
                    } else {
                        $d->endReason = 50; //Ended without bids
                        $d->save();
                    }

                    $d->delete();

                    Log::debug('Auto: Ended auction ' . $d->title . ', End at: ' . $d->end_at);
                    echo 'Auto: Ended auction ' . $d->title . '<br/>';
//                    echo '<hr/>';
                }
            });

//        \market\models\Market::where('marketType', 4)
//            ->where('end_at', '<', $timestamp)
//            ->where('deleted_at', null)
//            ->with('bids')
//            ->chunk(10, function ($toDelete) {
//                foreach ($toDelete as $d) {
//                    if ($d->bids->count() > 0) {
//                        $d->endReason = 0; //Sold
//                        $d->save();
//                    } else {
//                        $d->endReason = 50; //Ended without bids
//                        $d->save();
//                    }
//
//                    $d->delete();
//
//                    Log::info('Auto: Ended auction ' . $d->title);
//                }
//            });
    }
}