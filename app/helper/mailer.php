<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-10-11
 * Time: 23:16
 */

namespace market\helper;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use market\models\Market;
use market\models\Message;
use market\models\User;

class mailer {

    protected $subjectSuffix;

    public function __construct()
    {
        $this->subjectSuffix = '(Marknad)';
    }

    public function sendMailNewPm($messageId)
    {
//        $message = Message::where('id', $messageId)->with('sender conversation.user1 conversation.user2')->first();
        $pm = Message::where('id', $messageId)->with('sender', 'conversation.getUser1', 'conversation.getUser2')->first();
//        $message = Message::where('id', $messageId)->with('sender')->first();

        if($pm)
        {
            $sender = $pm->sender;

            //Get reciever
            if($sender != $pm->conversation->getUser1)
            {
                $receiver = $pm->conversation->getUser1;
            }
            else
            {
                $receiver = $pm->conversation->getUser2;
            }

            //Check if reciever want mail
            if($receiver->mailNewPm)
            {
                //Send mail via view, new pm from from, Title, Message, link to conversation
                Mail::send('emails.newPM', [
                    'sender' => $sender,
                    'receiver' => $receiver,
                    'pm' => $pm,
                    'title' => $pm->conversation->title
                ], function($message) use ($sender, $receiver, $pm) {
                    $message
                        ->from($sender->email, $sender->username . ' ' . $this->subjectSuffix)
                        ->to($receiver->email)
                        ->subject('Nytt PM: ' . $pm->conversation->title);
                });
            }
        }
    }

    public function sendMailNewBidOnMyAuction($bid)
    {
        Log::debug('sendMailNewBidOnMyAuction is triggered');
        Log::debug($bid);
        //Get auction->auctioner
        if($bid)
        {
            Log::debug('bid is true');

            $auction = Market::where('id', $bid->auctionId)->with('user')->first();
            if($auction)
            {
                Log::debug('auction is true');
                Log::debug('Auction.user: ' . $auction->user);

                //Check if auctioner want email
                if($auction->user->mailNewBidMyAuction)
                {
                    Log::debug('user want mail');

                    //Get bidder
                    $bidder = User::where('id', $bid->bidder)->first();
                    Log::debug('Bidder: ' . $bidder);

                    if($bidder)
                    {
                        Log::debug('bidder is true, sending mail');

                        $subject = 'Nytt bud på ' . $auction->title;
                        //TODO: Make this a queue
                        Mail::send('emails.newBidOnMyAuction', [
                            'auction' => $auction,
                            'bid' => $bid,
                            'bidder' => $bidder,
                            'title' => $subject
                        ], function($message) use ($auction, $bidder, $subject) {
                            $message
                               ->from($bidder->email, $bidder->username . ' ' . $this->subjectSuffix)
                                ->to($auction->user->email)
                                ->subject($subject);
                        });
                    }
                }
            }
        }
    }

    public function sendMailMyAuctionEnded($auctionId)
    {
        //TODO:
        //Get auction->auctioner
        //Check if auctioner want email
        //Send mail, Auction ended, Title, bids count, highest bid, winner, profilelink and uppmaning to contact winner
    }

    public function sendMailToWinnerOfAuction($auctionId)
    {
        //TODO:
        //Chech if there are any bids
        //Get bids->highest->user
        //Check if user want mail
        //Get auction
        //Send mail, Auction ended, Title, bids count, highest bid, winner, profilelink and uppmaning to contact seller (same mail as above)
    }

    public function sendMailNewBidWatchedAuction($auctionId)
    {
        //TODO:
        //Get watchers
        //Loop over watchers
        //Check if watcher want email
        //Send email, new bid XX on XX, your highset bid XX, Ending at XX and link to auction
    }

    public function sendMailEndedWatchedMarket($marketId)
    {
        //TODO:
        //Get watchers
        //Loop over watchers
        //Check if watcher want email
        //Send email, A ad you watch has been terminated, title, time, reason, link
    }

    public function sendMailNewQuestionAsked($question)
    {

    }
}