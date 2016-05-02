<?php

namespace market\Jobs;

use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use market\helper\mailer;
use market\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use market\models\Bid;

class sendMailToUserOnNewBidMyAuction extends Job implements SelfHandling//, ShouldQueue
{
    //TODO: Queue

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
        $bid = Bid::with('user')->with('market.user')->find($this->bidId);
        if ($bid != null && $bid->market->user->id == $this->authId && $bid->market->user->mailNewBidMyAuction) {

            Mail::send('emails.newBidOnMyAuction', [
                'auction' => $bid->market,
                'bid' => $bid,
                'bidder' => $bid->user,
                'title' => 'Nytt bud på ' . $bid->market->title
            ], function ($message) use ($bid) {
                $message
                    ->from($bid->user->email, $bid->user->username . ' ' . env('EMAIL_TITLE_SUFFIX'))
                    ->to($bid->market->user->email)
                    ->subject('Nytt bud på ' . $bid->market->title);
            });
        }
    }
}
