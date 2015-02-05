<?php

/*
|--------------------------------------------------------------------------
| Bind model
|--------------------------------------------------------------------------
|
| Bind a wild-card to a model to use in routes
|
*/
//TODO:Create model bindning and alter controllers
//http://laravel.com/docs/master/routing#route-model-binding
Route::model('market', 'market\Market');
//Route::model('user', 'market\User');
//Route::bind('market', function($id, $route)
//{
////	dd(market\Market::withTrashed()->find($id));
//	return market\Market::withTrashed()->find($id);
//});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('/', 'MarketsController@index');

Route::get('markets', ['as' => 'markets.index', 'uses' => 'MarketsController@index']);
Route::get('markets/filter', ['as' => 'markets.filter', 'uses' => 'MarketsController@filter'] );
Route::get('markets/create', ['as' => 'markets.create', 'uses' => 'MarketsController@create', 'middleware' => 'auth']);
Route::post('markets', ['as' => 'markets.store', 'uses' => 'MarketsController@store', 'middleware' => 'auth']);
Route::get('markets/{markets}', ['as' => 'markets.show', 'uses' => 'MarketsController@show']);
Route::get('markets/{markets}/edit', ['as' => 'markets.edit', 'uses' => 'MarketsController@edit', 'middleware' => 'auth']);
Route::patch('markets/{markets}', ['as' => 'markets.update', 'uses' => 'MarketsController@update', 'middleware' => 'auth']);
Route::get('markets/delete/{market}', ['as' => 'markets.delete', 'uses' => 'MarketsController@delete', 'middleware' => 'auth']);
Route::delete('markets', ['as' => 'markets.destroy', 'uses' => 'MarketsController@destroy', 'middleware' => 'auth']);
Route::get('search', ['as' => 'markets.search', 'uses' => 'MarketsController@search']);

// Development routes
Route::get('/dev', function(){
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



/*
|--------------------------------------------------------------------------
| Authentication & Password Reset Controllers
|--------------------------------------------------------------------------
|
| These two controllers handle the authentication of the users of your
| application, as well as the functions necessary for resetting the
| passwords for your users. You may modify or remove these files.
|
*/

/*Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);*/

Route::get('login', ['as' => 'accounts.login', 'uses' => 'AccountController@login' ]);
Route::post('login', ['as' => 'accounts.login.post', 'uses' => 'AccountController@loginPost' ]);

//TODO: Make this a post request
Route::get('logout', ['as' => 'accounts.logout', 'uses' => 'AccountController@logout', 'middleware' => 'auth']);

Route::get('register', ['as' => 'accounts.register', 'uses' => 'AccountController@register' ]);
Route::post('register', ['as' => 'accounts.register.post', 'uses' => 'AccountController@registerPost', 'before' => 'csrf']);

//TODO: Add filter for access only if logged in user is the same as requested user
Route::get('profile/{user}', ['as' => 'accounts.profile', 'uses' => 'AccountController@show', 'middleware' => 'auth']);
Route::get('profile/blockmarket/{market}', ['as' => 'accounts.blockMarket', 'uses' => 'AccountController@blockMarket', 'middleware' => 'auth']);
Route::get('profile/unblockmarket/{market}', ['as' => 'accounts.unblockMarket', 'uses' => 'AccountController@unblockMarket', 'middleware' => 'auth']);
Route::get('profile/blockseller/{user}', ['as' => 'accounts.blockSeller', 'uses' => 'AccountController@blockSeller', 'middleware' => 'auth']);
Route::get('profile/unblockseller/{user}', ['as' => 'accounts.unblockSeller', 'uses' => 'AccountController@unblockSeller', 'middleware' => 'auth']);
