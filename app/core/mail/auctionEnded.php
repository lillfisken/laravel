<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-12-07
 * Time: 22:13
 */

namespace market\core\mail;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use market\models\Bid;
use market\models\Market;

class auctionEnded extends base
{
    protected $market;
    protected $marketId;
    protected $subjectSuffix;
    protected $highestBid;

    public function __construct($marketId)
    {
        Log::debug('core/mail/auctionEnded, marketId: ' . $marketId);
        $this->market = Market::withTrashed()->with(['bids', 'user', 'watched.user'])->find($marketId);
//        $this->market = Market::withTrashed()->with(['bids', 'user', 'watched.user'])->find($marketId);
        $this->highestBid = Bid::where('auctionId', $marketId)
            ->orderBy('bid', 'desc')
            ->with('user')
            ->first();
        $this->marketId = $marketId;
        $this->subjectSuffix = ENV('EMAIL_TITLE_SUFFIX');
        Log::debug('constructor end');
    }

    public function sendMailToWinner()
    {
        Log::debug('sendMailToWinner: ' . $this->market->title);
        if($this->highestBid != null && $this->highestBid->user->email)
        {
            //We have a winner, and he wants a mail
            $data = [
                'title' => 'Vunnen auktion: ' . $this->market->title . ' ' . $this->subjectSuffix,
                'sender' => $this->market->user,
                'receiver' => $this->highestBid->user,
                'auction' => $this->market
            ];

            $this->sendMail('emails.winnerAuction', $data);
        }
    }

    public function sendMailToWatchers()
    {
        Log::debug('sendMailToWatchers');
        foreach($this->market->watched as $watch)
        {
            $data = [
                'title' => 'Bevakad auktion "' . $this->market->title . '" avslutad ' . $this->subjectSuffix,
                'sender' => $this->market->user,
                'receiver' => $watch->user,
                'auction' => $this->market
            ];

            if($data['receiver']->mailAuctionWatched == 1)
            {
                $this->sendMail('emails.watcherOnAuctionEnded', $data);
            }
        }
    }

    public function sendMailToOwner()
    {
        Log::debug('sendMailToOwner');

        $data = [
            'title' => 'Din auktion "' . $this->market->title . '" är avslutad. ' . $this->subjectSuffix,
            'sender' => $this->market->user,
            'receiver' => $this->market->user,
            'auction' => $this->market,
            'highestBid' => $this->highestBid
        ];

        if($this->market->bids->count() > 0)
        {
            Log::debug('Sending mail to owner with bid');
            $this->sendMail('emails.ownerEndedAuctionWithBids', $data);
        }
        else
        {
            Log::debug('Sending mail to owner without bid');
            $this->sendMail('emails.ownerEndedAuctionWithoutBids', $data);
        }
    }
}