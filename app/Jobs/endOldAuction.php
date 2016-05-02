<?php

namespace market\Jobs;

use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use market\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use market\models\Market;

class endOldAuction extends Job implements SelfHandling//, ShouldQueue
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $timestamp = Carbon::createFromTimestamp(time());
        Log::debug('jobs/endOldAuctions->handle()');

        /*
         * Get all market to delete
         * Loop over and delete one by one
         * Log each deletion
         * This preserves eloquent delete
         */
//dd('endOldAuctions');
        Market::where('marketType', 4)
            ->where('end_at', '<', $timestamp)
            ->whereNull('deleted_at')
            ->with('bids')
            ->chunk(10, function ($toDelete) {
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
                }
            });
    }
}
