<?php namespace market\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use market\helper\cron;

class Kernel extends ConsoleKernel {

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
        $cron = new cron();

        $cron->endOldAuctions();

        $schedule->call(function() use($cron) {
            $cron->cleanOldPhpBBConnect();
        })->everyTenMinutes();

        $schedule->call(function() use($cron){
            $cron->deleteOldTempImages();
        })->daily();
	}

}
