<?php namespace market\Providers\market;

use Illuminate\Support\ServiceProvider;

class messageServiceProvider extends ServiceProvider {

	protected $defer = true;

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
		$this->registerNewPm();
	}

	private function registerNewPm()
	{
		$this->app->bind('market\core\message\newPm', function(){
			return new \market\core\message\newPm();
		});
	}

	public function provides()
	{
		return [
            'market\core\message\newPm',
        ];
	}

}
