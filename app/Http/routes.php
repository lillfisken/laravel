<?php

//--------------------------------------------------------------------------

//region Model Binding

//TODO:Create model bindning and alter controllers
//http://laravel.com/docs/master/routing#route-model-binding
Route::model('market', 'market\Market');
Route::bind('user', function($username)
{
	//dd($username);
	 return market\User::where('username', '=', $username)->firstOrFail();
});
//Route::model('user', 'market\User');

//Route::bind('market', function($id, $route)
//{
////	dd(market\Market::withTrashed()->find($id));
//	return market\Market::withTrashed()->find($id);

//endregion

//--------------------------------------------------------------------------

//region Market Routes

Route::get('/', 'MarketsController@index');

Route::get('markets', ['as' => 'markets.index', 'uses' => 'MarketsController@index']);
Route::get('markets/filter', ['as' => 'markets.filter', 'uses' => 'MarketsController@filter'] );
Route::get('markets/create', ['as' => 'markets.create', 'uses' => 'MarketsController@create', 'middleware' => 'auth']);
Route::get('markets/reactivate/{market}', ['as' => 'markets.reactivate', 'uses' => 'MarketsController@reactivate', 'middleware' => 'auth']);
Route::post('markets', ['as' => 'markets.store', 'uses' => 'MarketsController@store', 'middleware' => 'auth']);
Route::get('markets/{markets}', ['as' => 'markets.show', 'uses' => 'MarketsController@show']);
Route::get('markets/{markets}/edit', ['as' => 'markets.edit', 'uses' => 'MarketsController@edit', 'middleware' => 'auth']);
Route::patch('markets/{markets}', ['as' => 'markets.update', 'uses' => 'MarketsController@update', 'middleware' => 'auth']);
Route::get('markets/delete/{market}', ['as' => 'markets.delete', 'uses' => 'MarketsController@delete', 'middleware' => 'auth']);
Route::delete('markets', ['as' => 'markets.destroy', 'uses' => 'MarketsController@destroy', 'middleware' => 'auth']);
Route::get('search', ['as' => 'markets.search', 'uses' => 'MarketsController@search']);

//endregion

//--------------------------------------------------------------------------

//region Development Routes

if(Config::get('app.debug'))
{
	Route::get('/dev', function(){
		dd(Config::get('app.debug'));
		return Redirect::to('foobar');

		$m = \market\Market::find('106');
		$countActive = $m->user->getUserActiveMarketsCount();
		$countAll = $m->user->getUserTotalMarketsCount();
		dd('Count active: ' . $countActive . '
		Count all: ' . $countAll);
	});
	Route::get('roadmap', ['as' => 'roadmap', 'uses' => 'DevController@road', 'middleware' => 'auth']);
	Route::get('geturl', ['as' => 'geturl', 'uses' => 'DevController@getUrl', 'middleware' => 'auth']);
	Route::get('session', ['as' => 'session', 'uses' => 'DevController@session', 'middleware' => 'auth']);
}
//endregion

//-----------------------------------------------------------------------------

//region Register/login- Routes

Route::get('login', ['as' => 'accounts.login', 'uses' => 'AccountController@login' ]);
Route::post('login', ['as' => 'accounts.login.post', 'uses' => 'AccountController@loginPost' ]);

//TODO: Make this a post request
Route::get('logout', ['as' => 'accounts.logout', 'uses' => 'AccountController@logout', 'middleware' => 'auth']);

Route::get('register', ['as' => 'accounts.register', 'uses' => 'AccountController@register' ]);
Route::post('register', ['as' => 'accounts.register.post', 'uses' => 'AccountController@registerPost', 'before' => 'csrf']);

//endregion

//--------------------------------------------------------------------------

//region Profile/account Routes

//TODO: Add filter/middleware for access only if logged in user is the same as requested user/ post requests???
Route::get('profile/{user}', ['as' => 'accounts.profile', 'uses' => 'AccountController@show', 'middleware' => 'auth']);
Route::get('profile/blockmarket/{market}', ['as' => 'accounts.blockMarket', 'uses' => 'AccountController@blockMarket', 'middleware' => 'auth']);
Route::get('profile/unblockmarket/{market}', ['as' => 'accounts.unblockMarket', 'uses' => 'AccountController@unblockMarket', 'middleware' => 'auth']);
Route::get('profile/blockseller/{user}', ['as' => 'accounts.blockSeller', 'uses' => 'AccountController@blockSeller', 'middleware' => 'auth']);
Route::get('profile/unblockseller/{user}', ['as' => 'accounts.unblockSeller', 'uses' => 'AccountController@unblockSeller', 'middleware' => 'auth']);

Route::get('profile/watched/{user}', ['as' => 'accounts.watched', 'uses' => 'AccountController@watched', 'middleware' => 'auth']);
Route::get('profile/active/{user}', ['as' => 'accounts.active', 'uses' => 'AccountController@active', 'middleware' => 'auth']);
Route::get('profile/trashed/{user}', ['as' => 'accounts.trashed', 'uses' => 'AccountController@trashed', 'middleware' => 'auth']);
Route::get('profile/blockedmarket/{user}', ['as' => 'accounts.blockedmarket', 'uses' => 'AccountController@blockedmarket', 'middleware' => 'auth']);
Route::get('profile/blockedseller/{user}', ['as' => 'accounts.blockedseller', 'uses' => 'AccountController@blockedseller', 'middleware' => 'auth']);

Route::get('profile/inbox/{user}', ['as' => 'accounts.inbox', 'uses' => 'AccountController@inbox', 'middleware' => 'auth']);
Route::get('profile/draft/{user}', ['as' => 'accounts.draft', 'uses' => 'AccountController@draft', 'middleware' => 'auth']);
Route::get('profile/sent/{user}', ['as' => 'accounts.sent', 'uses' => 'AccountController@sent', 'middleware' => 'auth']);
Route::get('profile/trash/{user}', ['as' => 'accounts.trash', 'uses' => 'AccountController@trash', 'middleware' => 'auth']);

Route::get('profile/settings/{user}', ['as' => 'accounts.settings', 'uses' => 'AccountController@settings', 'middleware' => 'auth']);

//endregion

//-----------------------------------------------------------------------------
