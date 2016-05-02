<?php

namespace market\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use market\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use market\models\eventMarket;
use market\models\eventUser;
use market\models\watchedMarketsByUser;

class addEventToUsersWhoWatchMarket extends Job implements SelfHandling//, ShouldQueue
{
    protected $marketEventId;
    protected $marketId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(eventMarket $marketEvent)
    {
        $this->marketId = $marketEvent->market;
        $this->marketEventId = $marketEvent->id;
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::debug('----- Handle addEventToUsersWhoWatchMarket');
        watchedMarketsByUser::where('market', $this->marketId)->chunk(10, function($watcheds) {
            foreach($watcheds as $watched)
            {
                //TODO: Is it possible to not register events on users own bid?
                eventUser::create([
                    'marketId' => $watched->market,
                    'userId' => $watched->user,
                    'eventId' => $this->marketEventId
                ]);
            }
        });
    }
}
