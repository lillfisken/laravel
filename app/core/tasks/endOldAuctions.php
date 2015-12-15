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

class endOldAuctions
{
    public function __construct()
    {

    }

    public function end()
    {
        $timestamp = Carbon::createFromTimestamp(time());
//        Log::debug('core/tasks/endOldAuctions->end()');

        /*
         * Get all market to delete
         * Loop over and delete one by one
         * Log each deletion
         * This preserves eloquent delete
         */

        $toDelete = \market\models\Market::where('marketType', 4)
            ->where('end_at', '<', $timestamp)
            ->where('deleted_at', null)
            ->get();

        foreach($toDelete as $d)
        {
            $d->delete();
            Log::info('Auto: Ended auction ' . $d->title);
        }
    }
}