<?php namespace market\Commands;

use Illuminate\Support\Facades\Log;
use market\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class sendMailNewPm extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

	protected $messageId;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($messageId)
	{
		$this->messageId = $messageId;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle(\market\core\message\newPm $newPm)
	{
		Log::debug('commands/send MailNewPm, messageId: ' . $this->messageId);
        $newPm->send($this->messageId);
	}

}
