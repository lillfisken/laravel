<?php namespace market\Providers;

use Illuminate\Support\ServiceProvider;

class coreServiceProvider extends ServiceProvider {

//	protected $defer = true;
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerTasks();
	}

	protected function registerTasks()
	{
		$this->app->bind('market\core\tasks\endOldAuctions', function(){
			return new \market\core\tasks\endOldAuctions;
		});

//		$this->app->bind('market\core\tasks\endOldAuctions', function(){
//			return new \market\core\tasks\endOldAuctions;
//		});
	}

	public function provides()
	{
		return [
				'market\core\tasks\endOldAuctions',
				'market\core\tasks\deleteOldTempImages',
		];
	}
}
