<?php namespace market\Commands;

use Illuminate\Support\Facades\Log;
use market\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use market\core\mail\auctionEnded;

class sendMailAuctionEnded extends Command implements SelfHandling {
    protected $auctionId;

    /**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($auctionId)
	{
		$this->auctionId = $auctionId;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		Log::debug('Commands/sendMailAuctionEnded: ' . $this->auctionId);
		//
        if($this->auctionId)
        {
            $mail = new auctionEnded($this->auctionId);
            $mail->sendMailToOwner();
            $mail->sendMailToWinner();
            $mail->sendMailToWatchers();
        }
	}

}
