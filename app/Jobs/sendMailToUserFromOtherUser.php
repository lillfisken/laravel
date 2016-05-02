<?php

namespace market\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use market\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

class sendMailToUserFromOtherUser extends Job implements SelfHandling//, ShouldQueue
{
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($sender, $receiver, $title, $body)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //TODO: Implement
        //Mail::send();
    }
}
