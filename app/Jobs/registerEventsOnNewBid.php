<?php

namespace market\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Bus\SelfHandling;
use market\models\Bid;
use market\models\eventMarket;

class registerEventsOnNewBid extends Job implements SelfHandling//, ShouldQueue
{
    protected $bidId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Bid $bid)
    {
        $this->bidId = $bid->id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::debug('----- Handle registerEventsOnNewBid');
        //get bid & create new eventMarket
        $bid = Bid::with(['market','user'])->find($this->bidId);
        if($bid)
        {
            eventMarket::create([
                'market' => $bid->market,
                'body' => 'Nytt bud: ' . $bid->bid . ' från ' . $bid->user->username
            ]);
        }
    }
}
