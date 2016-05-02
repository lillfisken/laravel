<?php namespace market\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use market\core\event\newBid;
use market\Jobs\addEventForEndedMarket;
use market\Jobs\addEventToUsersWhoWatchMarket;
use market\Jobs\registerEventsOnNewBid;
use market\Jobs\sendMailToHighestBidderOnAuction;
use market\Jobs\sendMailToUserOnNewBidMyAuction;
use market\Jobs\sendMailToWatchersOnMarketWhenMarketIsEnded;
use market\Jobs\sendMailToWatchersOnMarketWhenNewBidIsPlaced;
use market\models\Bid;
use market\models\eventMarket;
use market\models\Market;

class EventServiceProvider extends ServiceProvider
{
    use DispatchesJobs;
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        Bid::created(function($bid) {
            $this->dispatch(new sendMailToWatchersOnMarketWhenNewBidIsPlaced($bid->Id, Auth::id()));
            $this->dispatch(new sendMailToUserOnNewBidMyAuction($bid->Id, Auth::id()));
            $this->dispatch(new registerEventsOnNewBid($bid->Id, Auth::id()));
        });
        Bid::updated(function($bid) {
            $this->dispatch(new sendMailToWatchersOnMarketWhenNewBidIsPlaced($bid, Auth::id()));
            $this->dispatch(new sendMailToUserOnNewBidMyAuction($bid, Auth::id()));
            $this->dispatch(new registerEventsOnNewBid($bid, Auth::id()));
        });

        eventMarket::created(function($eventMarket) {
           $this->dispatch(new addEventToUsersWhoWatchMarket($eventMarket));
        });

        Market::deleted(function($market) {
            $this->dispatch(new sendMailToHighestBidderOnAuction($market));
            $this->dispatch(new sendMailToWatchersOnMarketWhenMarketIsEnded($market));
            $this->dispatch(new addEventForEndedMarket($market));
        });
    }
}
