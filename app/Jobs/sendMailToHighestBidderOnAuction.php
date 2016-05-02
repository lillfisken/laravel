<?php

namespace market\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use market\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

class sendMailToHighestBidderOnAuction extends Job implements SelfHandling//, ShouldQueue
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //TODO: Implement
        //On market Delete
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //TODO: Implement
//
    }
}
