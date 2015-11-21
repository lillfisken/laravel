<?php namespace market\Providers\market;

use Illuminate\Support\ServiceProvider;

class bidServiceProvider extends ServiceProvider {

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
		//
	}

	private function registerNewBidOnWatched()
	{
		$this->app->bind('market\core\watched\newBidOnWatched', function(){
			return new \market\core\watched\newBidOnWatched;
		});
	}

	public function provides()
	{
		return [
				'market\core\watched\newBidOnWatched',
			];
	}
}

