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

//Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

$router->get('roadmap', 'HomeController@road');
//$router->get('dev', 'HomeController@dev');
//$router->post('postDev', 'HomeController@postdev');

$router->get('/', 'MarketsController@index');

Route::resource('markets', 'MarketsController');

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

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
