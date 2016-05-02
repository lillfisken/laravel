<?php namespace market\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Events\Dispatcher;
use market\core\tasks\cron;
use market\Jobs\deleteOldLogFiles;
use market\Jobs\deleteOldPhpBBConnect;
use market\Jobs\deleteOldTempImages;
use market\Jobs\endOldAuction;

class Kernel extends ConsoleKernel {

	use DispatchesJobs;

	protected $cron;

	public function __construct(Application $app, Dispatcher $events)
	{
		parent::__construct($app, $events);
	}

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'market\Console\Commands\Inspire',
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		Log::info('Cron running');

        $this->dispatch(new endOldAuction());
		//TODO: FIX CRON

//        $cron->endOldAuctions();
////
        $schedule->call(function() {
//            $this->dispatch(new deleteOldPhpBBConnect());
//            $cron->cleanOldPhpBBConnect();
        })->everyTenMinutes();
////
        $schedule->call(function() {
//            $this->dispatch(new deleteOldTempImages());
//            $this->dispatch(new deleteOldLogFiles());
//            $cron->deleteOldTempImages();
        })->daily();
	}
}
