<?php

namespace market\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use market\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use market\models\Bid;
use market\models\watchedMarketsByUser;

class sendMailToWatchersOnMarketWhenNewBidIsPlaced extends Job implements SelfHandling//, ShouldQueue
{
    protected $bidId;
    protected $authId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($bid, $authId)
    {
        $this->bidId = $bid->id;
        $this->authId = $authId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Get all watchers
        //  Send email to everyone who want one, bidder not same as auth
        $bid = Bid::find($this->bidId);
        if ($bid) {
            dd('yvgbhunjmkl', $bid);
            watchedMarketsByUser::where('market', $bid->auctionId)
                ->where('user', '!=', $this->authId)
                ->with(['User'])
                ->chunk(10, function ($watcheds) use ($bid) {
                    foreach ($watcheds as $watched) {
//                        dd($watched, $watched->User);
                        if ($watched->User->mailAuctionWatched) {
                            //send
//                            dd('bgtvufcnhxjzsko,al');
                            Mail::send('emails.newBidOnWatchedAuction', [
                                'auction' => $bid->market,
                                'bid' => $bid,
                                'bidder' => $bid->user,
                                'title' => 'Nytt bud på bevakad annons: ' . $bid->market->title
                            ], function ($message) use ($bid, $watched) {
                                $message
                                    ->from($bid->user->email, $bid->user->username . ' ' . env('EMAIL_TITLE_SUFFIX'))
                                    ->to($watched->User->email)
                                    ->subject('Nytt bud på ' . $bid->market->title);
                            });
                        }
                    }
                });
        }
    }
}
