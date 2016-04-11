<?php namespace market\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Events\Dispatcher;
use market\core\tasks\cron;

class Kernel extends ConsoleKernel {

	protected $cron;

	public function __construct(cron $cron, Application $app, Dispatcher $events)
	{
		$this->cron = $cron;
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
		Log::debug('Cron running');
        $cron = $this->cron;

        $cron->endOldAuctions();
//
        $schedule->call(function() use($cron) {
            $cron->cleanOldPhpBBConnect();
        })->everyTenMinutes();
//
        $schedule->call(function() use($cron){
            $cron->deleteOldTempImages();
        })->daily();
	}
}
