<?php

namespace market\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use market\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use market\models\eventMarket;
use market\models\Market;

class addEventForEndedMarket extends Job implements SelfHandling//, ShouldQueue
{
    protected $marketId;

    /**
     * Create a new job instance.
     *
     * @param $market
     */
    public function __construct(Market $market)
    {
        $this->marketId = $market->id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $market = Market::find($this->marketId);
        if($market != null)
        {
            $body = $market->title . ' har avslutats ' . $market->deleted_at . '. ' . $market->getEndReasonName();
            $newEvent = new eventMarket();
            $newEvent->market = $market->id;
            $newEvent->body = $body;
            $newEvent->save();
        }
    }
}
