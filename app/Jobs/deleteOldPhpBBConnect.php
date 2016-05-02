<?php

namespace market\Jobs;

use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use market\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use market\models\phpBBconnect;

class deleteOldPhpBBConnect extends Job implements SelfHandling//, ShouldQueue
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
        $timestamp->addMinute(config('market.phpBBconnectValidMinutes'));

        $deleted = phpBBconnect::where('created_at', '<', $timestamp)->delete();
        if ($deleted > 0) {
            Log::info('Deleted old phpBBconnect: ' . $deleted);
        }
    }
}
