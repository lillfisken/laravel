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
Route::post('question', ['as' => 'markets.question', 'uses' => 'MarketsController@question', 'middleware' => 'auth']);
Route::get('markets/pm/{title}/{toUser}', ['as' => 'markets.pm', 'uses' => 'MarketsController@sendPm', 'middleware' => 'auth']);

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

//TODO: Alter route to not useuser if not neccesarey
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

Route::get('profile/settings/show', ['as' => 'accounts.settings', 'uses' => 'AccountController@settings', 'middleware' => 'auth']);


//endregion

//--------------------------------------------------------------------------

//region Message
Route::get('message/inbox', ['as' => 'message.inbox', 'uses' => 'MessageController@inbox', 'middleware' => 'auth']);
Route::get('message/conversation/{conversationId}', ['as' => 'message.show', 'uses' => 'MessageController@show', 'middleware' => 'auth']);

Route::get('message/draft', ['as' => 'message.draft', 'uses' => 'MessageController@draft', 'middleware' => 'auth']);
Route::get('message/trash', ['as' => 'message.trash', 'uses' => 'MessageController@trash', 'middleware' => 'auth']);
Route::get('message/new', ['as' => 'message.new', 'uses' => 'MessageController@newMessage', 'middleware' => 'auth']);
Route::post('message/new', ['as' => 'message.send', 'uses' => 'MessageController@sendMessage', 'middleware' => 'auth']);

Route::get('message/mail', ['as' => 'message.mail', 'uses' => 'MessageController@mail', 'middleware' => 'auth']);
Route::post('message/mail', ['as' => 'message.mail', 'uses' => 'MessageController@mailPost', 'middleware' => 'auth']);

//endregion


//-----------------------------------------------------------------------------
