<?php

namespace market\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use market\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use market\models\Market;
use market\models\watchedMarketsByUser;

class sendMailToWatchersOnMarketWhenMarketIsEnded extends Job implements SelfHandling//, ShouldQueue
{
    protected $marketId;

    /**
     * Create a new job instance.
     *
     * @return void
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
        watchedMarketsByUser::where('market', $this->marketId)
            ->with('User')
            ->with(['Market.bids', 'Market.user'])
            ->chunk(10, function ($watcheds) {
                foreach ($watcheds as $watched) {
                   if($watched->User->mailMarketEnded)
                   {
//                       dd($watched);
                       Mail::send('emails.watchedMarketEnded', [
                           'market' => $watched->Market,
                           'title' => 'En bevakad annons har avslutats: ' . $watched->Market->title
                       ], function ($message) use ($watched) {
//                           dd($watched);
                           $message
                               ->from($watched->Market->user->email, $watched->Market->user->username . ' ' . env('EMAIL_TITLE_SUFFIX'))
                               ->to($watched->User->email)
                               ->subject('En bevakad annons har avslutats. ' . $watched->Market->title);
                       });
                   }
                }
            });
        //TODO: Implement
//
    }
}
