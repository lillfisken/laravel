<?php

//use Illuminate\Contracts\Logging\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use market\helper\markets\auction;
//--------------------------------------------------------------------------

//region Model Binding

//TODO:Create model bindning and alter controllers
//http://laravel.com/docs/master/routing#route-model-binding
//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
//use Laracurl;
//use GuzzleHttp;


//Route::model('market', 'market\Market');
Route::bind('user', function($username)
{
//	dd($username);
//    dd(market\User::where('username', '=', $username)->firstOrFail());
	 return market\models\User::where('username', '=', $username)->firstOrFail();
});
//Route::model('user', 'market\User');

//endregion

//--------------------------------------------------------------------------
Route::get('/', 'MarketsController@index');
//market
Route::group(['prefix'=>'market'], function(){
    Route::get('/', ['as' => 'markets.index', 'uses' => 'MarketsController@index']);
    Route::get('filter', ['as' => 'markets.filter', 'uses' => 'MarketsController@filter'] );
    Route::get('search', ['as' => 'markets.search', 'uses' => 'MarketsController@search']);

    Route::get('pm/{title}/{toUser}', ['as' => 'markets.pm', 'uses' => 'MarketsController@sendPm', 'middleware' => 'auth']);
    Route::post('question', ['as' => 'markets.question', 'uses' => 'MarketsController@question', 'middleware' => 'auth']);
});

//sell
Route::group(['prefix' => 'sell'], function(){
//    Route::get('create', ['as' => 'markets.create', 'uses' => 'MarketsController@create', 'middleware' => 'auth']);
////    Route::get('{market}', ['as' => 'markets.reactivate', 'uses' => 'MarketsController@reactivate', 'middleware' => 'auth']);
//    Route::post('/', ['as' => 'markets.store', 'uses' => 'MarketsController@store']);
//    Route::get('show/{id}', ['as' => 'markets.show', 'uses' => 'MarketsController@show']);
//    Route::get('{markets}/edit', ['as' => 'markets.edit', 'uses' => 'MarketsController@edit', 'middleware' => 'auth']);
//    Route::patch('{markets}', ['as' => 'markets.update', 'uses' => 'MarketsController@update', 'middleware' => 'auth']);
//    Route::get('delete/{market}', ['as' => 'markets.delete', 'uses' => 'MarketsController@delete', 'middleware' => 'auth']);
//    Route::delete('/', ['as' => 'markets.destroy', 'uses' => 'MarketsController@destroy', 'middleware' => 'auth']);
//    Route::get('search', ['as' => 'markets.search', 'uses' => 'MarketsController@search']);

    $controller = 'Markets\SellController';
    $routeBase = 'sell';

    //Create
    Route::get('create', ['as' => $routeBase . '.create', 'uses' => $controller . '@createForm', 'middleware' => 'auth']);
    Route::post('create', ['as' => $routeBase . '.store', 'uses' => $controller . '@create', 'middleware' => 'auth']);

    //Read
    Route::get('show/{id}', ['as'=> $routeBase . '.show', 'uses'=> $controller . '@show']);

    //Update
    Route::get('/update/{id}', ['as' => $routeBase . '.update', 'uses' =>  $controller . '@updateForm', 'middleware' => 'auth']);
    Route::post('/update', ['as' => $routeBase . '.update.store', 'uses' =>  $controller . '@update', 'middleware' => 'auth']);

    //Delete
    Route::get('delete/{market}', ['as' => $routeBase . '.destroy.get', 'uses' =>  $controller . '@destroyGet', 'middleware' => 'auth']);
    Route::delete('delete', ['as' => $routeBase . '.destroy.post', 'uses' =>  $controller . '@destroyPost', 'middleware' => 'auth']);

    //Misc

});

//buy
Route::group(['prefix' => 'buy'], function(){
    $controller = 'Markets\BuyController';
    $routeBase = 'buy';

    //Create
    Route::get('/', ['as' => $routeBase . '.create', 'uses' => $controller . '@createForm', 'middleware' => 'auth']);
    Route::post('/', ['as' => $routeBase . '.store', 'uses' => $controller . '@create', 'middleware' => 'auth']);

    //Read
    Route::get('show/{id}', ['as'=> $routeBase . '.show', 'uses'=> $controller . '@show']);

    //Update
    Route::get('/update/{id}', ['as' => $routeBase . '.update', 'uses' =>  $controller . '@updateForm', 'middleware' => 'auth']);
    Route::post('/update', ['as' => $routeBase . '.update.store', 'uses' =>  $controller . '@update', 'middleware' => 'auth']);

    //Delete
    Route::get('delete/{market}', ['as' => $routeBase . '.destroy.get', 'uses' =>  $controller . '@destroyGet', 'middleware' => 'auth']);
    Route::delete('delete', ['as' => $routeBase . '.destroy.post', 'uses' =>  $controller . '@destroyPost', 'middleware' => 'auth']);

    //Misc

});

//giveaway
Route::group(['prefix' => 'giveaway'], function(){
    $controller = 'Markets\GiveawayController';
    $routeBase = 'giveaway';

    //Create
    Route::get('/', ['as' => $routeBase . '.create', 'uses' => $controller . '@createForm', 'middleware' => 'auth']);
    Route::post('/', ['as' => $routeBase . '.store', 'uses' => $controller . '@create', 'middleware' => 'auth']);

    //Read
    Route::get('show/{id}', ['as'=> $routeBase . '.show', 'uses'=> $controller . '@show']);

    //Update
    Route::get('/update/{id}', ['as' => $routeBase . '.update', 'uses' =>  $controller . '@updateForm', 'middleware' => 'auth']);
    Route::post('/update', ['as' => $routeBase . '.update.store', 'uses' =>  $controller . '@update', 'middleware' => 'auth']);

    //Delete
    Route::get('delete/{market}', ['as' => $routeBase . '.destroy.get', 'uses' =>  $controller . '@destroyGet', 'middleware' => 'auth']);
    Route::delete('delete', ['as' => $routeBase . '.destroy.post', 'uses' =>  $controller . '@destroyPost', 'middleware' => 'auth']);

    //Misc

});

//change
Route::group(['prefix' => 'change'], function(){
    $controller = 'Markets\ChangeController';
    $routeBase = 'change';

    //Create
    Route::get('/', ['as' => $routeBase . '.create', 'uses' => $controller . '@createForm', 'middleware' => 'auth']);
    Route::post('/', ['as' => $routeBase . '.store', 'uses' => $controller . '@create', 'middleware' => 'auth']);

    //Read
    Route::get('show/{id}', ['as'=> $routeBase . '.show', 'uses'=> $controller . '@show']);

    //Update
    Route::get('/update/{id}', ['as' => $routeBase . '.update', 'uses' =>  $controller . '@updateForm', 'middleware' => 'auth']);
    Route::post('/update', ['as' => $routeBase . '.update.store', 'uses' =>  $controller . '@update', 'middleware' => 'auth']);

    //Delete
    Route::get('delete/{market}', ['as' => $routeBase . '.destroy.get', 'uses' =>  $controller . '@destroyGet', 'middleware' => 'auth']);
    Route::delete('delete', ['as' => $routeBase . '.destroy.post', 'uses' =>  $controller . '@destroyPost', 'middleware' => 'auth']);

    //Misc

});

//auction
Route::group(['prefix' => 'auction'], function(){
    $controller = 'Markets\AuctionController';
    $routeBase = 'auction';

    //Create
    Route::get('/', ['as' => $routeBase . '.create', 'uses' => $controller . '@createForm', 'middleware' => 'auth']);
    Route::post('/', ['as' => $routeBase . '.store', 'uses' => $controller . '@create', 'middleware' => 'auth']);

    //Read
    Route::get('show/{id}', ['as'=> $routeBase . '.show', 'uses'=> $controller . '@show']);

    //Update
    Route::get('/update/{id}', ['as' => $routeBase . '.update', 'uses' =>  $controller . '@updateForm', 'middleware' => 'auth']);
    Route::post('/update', ['as' => $routeBase . '.update.store', 'uses' =>  $controller . '@update', 'middleware' => 'auth']);

    //Delete
    Route::get('delete/{market}', ['as' => $routeBase . '.destroy.get', 'uses' =>  $controller . '@destroyGet', 'middleware' => 'auth']);
    Route::delete('delete', ['as' => $routeBase . '.destroy.post', 'uses' =>  $controller . '@destroyPost', 'middleware' => 'auth']);

    //Misc
    Route::post('placebid', ['as' => 'auction.placeBid', 'uses' =>  $controller . '@placeBid', 'middleware' => 'auth']);
    Route::get('bids/{markets}', ['as' => 'auction.bids', 'uses' =>  $controller . '@showAllBids', 'middleware' => 'auth']);

});

//--------------------------------------------------------------------------
if(Config::get('app.debug') == 'true')
{

    Route::controller('dev', 'DevController');

    //http://stackoverflow.com/questions/19131731/laravel-4-logging-sql-queries
//    Event::listen('illuminate.query', function($query, $bindings, $time, $name)
//    {
//        $data = compact('bindings', 'time', 'name');
//
//        // Format binding data for sql insertion
//        foreach ($bindings as $i => $binding)
//        {
//            if ($binding instanceof \DateTime)
//            {
//                $bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
//            }
//            else if (is_string($binding))
//            {
//                $bindings[$i] = "'$binding'";
//            }
//        }
//
//        // Insert bindings into query
//        $query = str_replace(array('%', '?'), array('%%', '%s'), $query);
//        $query = vsprintf($query, $bindings);
//
//        Log::info($query, $data);
//    });
}
//-----------------------------------------------------------------------------
//auth
Route::group(['prefix' => 'auth'], function(){
    Route::get('login', ['as' => 'accounts.login', 'uses' => 'AccountController@login' ]);
    Route::post('login', ['as' => 'accounts.login.post', 'uses' => 'AccountController@loginPost' ]);

    //TODO: Make this a post request
    Route::get('logout', ['as' => 'accounts.logout', 'uses' => 'AccountController@logout', 'middleware' => 'auth']);

    Route::get('register', ['as' => 'accounts.register', 'uses' => 'AccountController@register' ]);
    Route::post('register', ['as' => 'accounts.register.post', 'uses' => 'AccountController@registerPost', 'before' => 'csrf']);

    Route::get('forgotPassword', ['as' => 'accounts.forgotPassword', 'uses' => 'Auth\PasswordController@getEmail', 'middleware' => 'guest']);
    Route::post('forgotPassword', ['as' => 'accounts.forgotPasswordPost', 'uses' => 'Auth\PasswordController@postEmail', 'middleware' => 'guest']);
    Route::get('resetPassword/{token}', ['as' => 'accounts.resetPassword', 'uses' => 'Auth\PasswordController@getReset', 'middleware' => 'guest']);
    Route::post('resetPassword', ['as' => 'accounts.resetPasswordPost', 'uses' => 'Auth\PasswordController@postReset', 'middleware' => 'guest']);

//    Route::controller('oauth', 'Auth\OAuthController');
});
//--------------------------------------------------------------------------
//Profile
Route::group(['prefix'=>'profile'], function(){
    //TODO: Alter route to not use user if not neccesarey
    Route::get('user/{user}', ['as' => 'accounts.profile', 'uses' => 'AccountController@show', 'middleware' => 'auth']);

    Route::get('blockmarket/{market}', ['as' => 'accounts.blockMarket', 'uses' => 'blockingController@blockMarketGet', 'middleware' => 'auth']);
    Route::post('blockmarket', ['as' => 'accounts.blockMarketPost', 'uses' => 'blockingController@blockMarketPost', 'middleware' => 'auth']);
    Route::get('unblockmarket/{market}', ['as' => 'accounts.unblockMarket', 'uses' => 'blockingController@unblockMarketGet', 'middleware' => 'auth']);
    Route::post('unblockmarket', ['as' => 'accounts.unblockMarketPost', 'uses' => 'blockingController@unblockMarketPost', 'middleware' => 'auth']);
    Route::get('blockedmarket/', ['as' => 'accounts.blockedmarket', 'uses' => 'AccountController@blockedmarket', 'middleware' => 'auth']);

    Route::get('blockseller/{userId}', ['as' => 'accounts.blockSeller', 'uses' => 'blockingController@blockSellerGet', 'middleware' => 'auth']);
    Route::post('blockseller', ['as' => 'accounts.blockSellerPost', 'uses' => 'blockingController@blockSellerPost', 'middleware' => 'auth']);
    Route::get('unblockseller/{userId}', ['as' => 'accounts.unblockSeller', 'uses' => 'blockingController@unblockSellerGet', 'middleware' => 'auth']);
    Route::post('unblockseller', ['as' => 'accounts.unblockSellerPost', 'uses' => 'blockingController@unblockSellerPost', 'middleware' => 'auth']);
    Route::get('blockedseller', ['as' => 'accounts.blockedseller', 'uses' => 'AccountController@blockedseller', 'middleware' => 'auth']);

    Route::get('watched', ['as' => 'accounts.watched', 'uses' => 'AccountController@watched', 'middleware' => 'auth']);
    Route::get('watchMarket/{id}', ['as' => 'accounts.watchMarket', 'uses' => 'AccountController@watchMarket', 'middleware' => 'auth']);
    Route::post('watchMarket', ['as' => 'accounts.watchMarketPost', 'uses' => 'AccountController@watchMarketPost', 'middleware' => 'auth']);
    Route::get('unwatchMarket/{id}', ['as' => 'accounts.unwatchMarket', 'uses' => 'AccountController@unwatch', 'middleware' => 'auth']);

    Route::get('active', ['as' => 'accounts.active', 'uses' => 'AccountController@active', 'middleware' => 'auth']);
    Route::get('inactive', ['as' => 'accounts.trashed', 'uses' => 'AccountController@trashed', 'middleware' => 'auth']);

    Route::get('settings/show', ['as' => 'accounts.settings.settings', 'uses' => 'AccountController@settings', 'middleware' => 'auth']);
    Route::post('settings/', ['as' => 'accounts.settings.save', 'uses' => 'AccountController@saveSettings', 'middleware' => 'auth']);
    Route::get('settings/password', ['as' => 'accounts.settings.password', 'uses' => 'AccountController@newPassword', 'middleware' => 'auth']);
    Route::post('settings/password', ['as' => 'accounts.settings.passwordPost', 'uses' => 'AccountController@newPasswordPost', 'middleware' => 'auth']);
    Route::get('settings/auth', ['as' => 'accounts.settings.oauth', 'uses' => 'AccountController@auth', 'middleware' => 'auth']);
    Route::post('settings/auth', ['as' => 'accounts.settings.oauthPost', 'uses' => 'AccountController@authPost', 'middleware' => 'auth']);
});
//--------------------------------------------------------------------------
//Message
Route::group(['prefix'=>'message'], function(){
    Route::get('inbox', ['as' => 'message.inbox', 'uses' => 'MessageController@inbox', 'middleware' => 'auth']);
    Route::get('conversation/{conversationId}', ['as' => 'message.show', 'uses' => 'MessageController@show', 'middleware' => 'auth']);

    Route::get('draft', ['as' => 'message.draft', 'uses' => 'MessageController@draft', 'middleware' => 'auth']);
    Route::get('trash', ['as' => 'message.trash', 'uses' => 'MessageController@trash', 'middleware' => 'auth']);
    Route::get('new', ['as' => 'message.new', 'uses' => 'MessageController@newMessage', 'middleware' => 'auth']);
    Route::post('new', ['as' => 'message.send', 'uses' => 'MessageController@sendMessage', 'middleware' => 'auth']);

    Route::get('mail', ['as' => 'message.mail', 'uses' => 'MessageController@mail', 'middleware' => 'auth']);
    Route::post('mail', ['as' => 'message.mail', 'uses' => 'MessageController@mailPost', 'middleware' => 'auth']);

});
//-----------------------------------------------------------------------------
//phpBB
Route::group(['prefix'=> 'phpBB'], function(){
    Route::post('login/{forumName}', ['as' => 'phpBB.login', 'uses' => 'phpBBController@loginUser' ]);
    Route::post('register/{forumName}', ['as' => 'phpBB.register', 'uses' => 'phpBBController@registerUser', 'middleware' => 'auth' ]);

    // CSRF excepted
    Route::post('response/{id}', ['as' => 'phpBB.respond', 'uses' => 'phpBBController@externalResponse' ]);

    Route::get('redirect/{token}', ['as' => 'phpBB.redirect', 'uses' => 'phpBBController@redirected' ]);
});

//---------------------------------------------------------------------------------
// Api
Route::group(['prefix' => 'api'], function(){
    Route::get('getAuctionEndTime/{auctionid}', ['as' => 'api.getAuctionEndTime', 'uses' => 'Markets\AuctionController@getAuctionEndTimeJson']);
});