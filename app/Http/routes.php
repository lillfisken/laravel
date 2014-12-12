<?php

/*
|--------------------------------------------------------------------------
| Bind model
|--------------------------------------------------------------------------
|
| Bind a wild-card to a model to use in routes
|
*/

Route::model('market', 'market\Market');
Route::model('user', 'market\User');

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
Route::get('markets/create', ['as' => 'markets.create', 'uses' => 'MarketsController@create', 'middleware' => 'auth']);
Route::post('markets', ['as' => 'markets.store', 'uses' => 'MarketsController@store', 'middleware' => 'auth']);
Route::get('markets/{markets}', ['as' => 'markets.show', 'uses' => 'MarketsController@show']);
Route::get('markets/{markets}/edit', ['as' => 'markets.edit', 'uses' => 'MarketsController@edit', 'middleware' => 'auth']);
Route::patch('markets/{markets}', ['as' => 'markets.update', 'uses' => 'MarketsController@update', 'middleware' => 'auth']);
Route::delete('markets', ['as' => 'markets.destroy', 'uses' => 'MarketsController@destroy', 'middleware' => 'auth']);
Route::get('search', ['as' => 'markets.search', 'uses' => 'MarketsController@search']);

// Development routes
Route::get('home', 'HomeController@index');
Route::get('roadmap', ['as' => 'roadmap', 'uses' => 'HomeController@road', 'middleware' => 'auth']);


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