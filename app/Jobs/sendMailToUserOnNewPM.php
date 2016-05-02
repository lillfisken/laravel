<?php

namespace market\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use market\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use market\models\Message;

class sendMailToUserOnNewPM extends Job implements SelfHandling//, ShouldQueue
{
    protected $pmId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($pm)
    {
        $this->pmId = $pm->id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pm = Message::with(['sender', 'conversation.getUser1', 'conversation.getUser2'])->find($this->pmId);
//        dd($message , $message->sender->mailNewPm);

        if($pm && $pm->sender->mailNewPm)
        {
            if($pm->conversation->getUser1->id == $pm->senderId)
            {
                $sender = $pm->conversation->getUser1;
                $receiver = $pm->conversation->getUser2;
            }
            else
            {
                $sender = $pm->conversation->getUser2;
                $receiver = $pm->conversation->getUser1;
            }

            Mail::send('emails.newBidOnWatchedAuction', [
                'message' => $pm,
                'title' => 'Nytt pm från ' . $sender->username
            ], function ($message) use ($pm, $sender, $receiver) {
                $message
                    ->from($sender->email, $sender->username . ' ' . env('EMAIL_TITLE_SUFFIX'))
                    ->to($receiver->email)
                    ->subject('Nytt PM från ' . $sender->username);
            });
        }
    }
}
