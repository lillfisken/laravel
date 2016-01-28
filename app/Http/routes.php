<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

Route::bind('user', function ($username) {
    return market\models\User::where('username', '=', $username)->firstOrFail();
});

//--------------------------------------------------------------------------
//market
Route::group([], function () {
    Route::get('/', ['as' => 'markets.index', 'uses' => 'MarketsController@index']);
    Route::get('filter', ['as' => 'markets.filter', 'uses' => 'MarketsController@filter']);
    Route::get('search', ['as' => 'markets.search', 'uses' => 'MarketsController@search']);

    Route::get('pm/{title}/{toUser}', ['as' => 'markets.pm', 'uses' => 'MarketsController@sendPm', 'middleware' => 'auth']);

    Route::post('question', ['as' => 'markets.question', 'uses' => 'question\\questionController@question', 'middleware' => 'auth']);
});

//markets
$marketRouteBase = [
    'sell',
    'buy',
    'change',
    'auction'
];
foreach ($marketRouteBase as $route) {
    Route::group(['prefix' => $route], function () use($route) {
        $routeBase = $route;

        //Create
        Route::get('create', [
            'as' => $routeBase . '.createNewForm',
            'uses' => 'Markets\\' . $routeBase . '\\createController' . '@showCreateForm',
            'middleware' => 'auth'
        ]);
        Route::post('createFromForm', [
            'as' => $routeBase . '.createFromForm',
            'uses' => 'Markets\\' . $routeBase . '\\createController' . '@createFromForm',
            'middleware' => 'auth'
        ]);
        Route::post('previewFromCreateForm', [
            'as' => $routeBase . '.previewFromCreateForm',
            'uses' => 'Markets\\' . $routeBase . '\\createController' . '@previewFromForm',
            'middleware' => 'auth'
        ]);
        Route::post('createFromPreview', [
            'as' => $routeBase . '.createFromPreview',
            'uses' => 'Markets\\' . $routeBase . '\\createController' . '@createFromPreview',
            'middleware' => 'auth'
        ]);
        Route::post('createFormFromPreview', [
            'as' => $routeBase . '.createFormFromPreview',
            'uses' => 'Markets\\' . $routeBase . '\\createController' . '@createFormFromPreview',
            'middleware' => 'auth'
        ]);

        //Read
        Route::get('show/{id}', [
            'as' => $routeBase . '.show',
            'uses' => 'Markets\\' . $routeBase . '\\readController' . '@show',
        ]);

        //Update
        Route::get('update/{id}', [
            'as' => $routeBase . '.updateForm',
            'uses' => 'Markets\\' . $routeBase . '\\updateController' . '@showUpdateForm',
            'middleware' => 'auth'
        ]);
        Route::post('updateFromForm', [
            'as' => $routeBase . '.updateFromForm',
            'uses' => 'Markets\\' . $routeBase . '\\updateController' . '@updateFromForm',
            'middleware' => 'auth'
        ]);
        Route::post('previewFromUpdateForm', [
            'as' => $routeBase . '.previewFromUpdateForm',
            'uses' => 'Markets\\' . $routeBase . '\\updateController' . '@previewFromForm',
            'middleware' => 'auth'
        ]);
        Route::post('updateFromPreview', [
            'as' => $routeBase . '.updateFromPreview',
            'uses' => 'Markets\\' . $routeBase . '\\updateController' . '@updateFromPreview',
            'middleware' => 'auth'
        ]);
        Route::post('updateFormFromPreview', [
            'as' => $routeBase . '.updateFormFromPreview',
            'uses' => 'Markets\\' . $routeBase . '\\updateController' . '@updateFormFromPreview',
            'middleware' => 'auth'
        ]);

        //Delete
        Route::get('delete/{market}', [
            'as' => $routeBase . '.destroy.get',
            'uses' => 'Markets\\' . $routeBase . '\\deleteController' . '@destroyGet',
            'middleware' => 'auth'
        ]);
        Route::delete('delete', [
            'as' => $routeBase . '.destroy.post',
            'uses' => 'Markets\\' . $routeBase . '\\deleteController' . '@destroyPost',
            'middleware' => 'auth'
        ]);

        //Misc

    });
}

//auction
Route::group(['prefix' => 'auction'], function () {
    //Misc
    Route::post('placebid', ['as' => 'auction.placeBid', 'uses' => 'Markets\\auction\\bidcontroller' . '@placeBid', 'middleware' => 'auth']);
    Route::get('bids/{markets}', ['as' => 'auction.bids', 'uses' => 'Markets\\auction\\bidcontroller' . '@showAllBids', 'middleware' => 'auth']);
});

//--------------------------------------------------------------------------
if (Config::get('app.debug') == 'true') {

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
Route::group(['prefix' => 'auth'], function () {
    Route::get('login', ['as' => 'accounts.login', 'uses' => 'account\loginController@login']);
    Route::post('login', ['as' => 'accounts.login.post', 'uses' => 'account\loginController@loginPost']);
    //TODO: Make this a post request?
    Route::get('logout', ['as' => 'accounts.logout', 'uses' => 'account\loginController@logout', 'middleware' => 'auth']);

    Route::get('register', ['as' => 'accounts.register', 'uses' => 'account\registerController@register']);
    Route::post('register', ['as' => 'accounts.register.post', 'uses' => 'account\registerController@registerPost', 'before' => 'csrf']);

    Route::get('forgotPassword', ['as' => 'accounts.forgotPassword', 'uses' => 'account\passwordController@getEmail', 'middleware' => 'guest']);
    Route::post('forgotPassword', ['as' => 'accounts.forgotPasswordPost', 'uses' => 'account\passwordController@postEmail', 'middleware' => 'guest']);
    Route::get('resetPassword/{token}', ['as' => 'accounts.resetPassword', 'uses' => 'account\passwordController@getReset', 'middleware' => 'guest']);
    Route::post('resetPassword', ['as' => 'accounts.resetPasswordPost', 'uses' => 'account\passwordController@postReset', 'middleware' => 'guest']);

//    Route::controller('oauth', 'Auth\OAuthController');
});
//--------------------------------------------------------------------------
//Profile
Route::group(['prefix' => 'profile'], function () {
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
    Route::get('unwatchMarket/{id}', ['as' => 'accounts.unwatchMarket', 'uses' => 'AccountController@unwatchMarket', 'middleware' => 'auth']);
    Route::post('unwatchMarket', ['as' => 'accounts.unwatchMarketPost', 'uses' => 'AccountController@unwatchMarketPost', 'middleware' => 'auth']);

    Route::get('active', ['as' => 'accounts.active', 'uses' => 'AccountController@active', 'middleware' => 'auth']);
    Route::get('inactive', ['as' => 'accounts.trashed', 'uses' => 'AccountController@trashed', 'middleware' => 'auth']);

    Route::get('settings/show', ['as' => 'accounts.settings.settings', 'uses' => 'account\settingsController@settings', 'middleware' => 'auth']);
    Route::post('settings/', ['as' => 'accounts.settings.save', 'uses' => 'account\settingsController@saveSettings', 'middleware' => 'auth']);
    Route::get('settings/password', ['as' => 'accounts.settings.password', 'uses' => 'account\changePasswordController@newPassword', 'middleware' => 'auth']);
    Route::post('settings/password', ['as' => 'accounts.settings.passwordPost', 'uses' => 'account\changePasswordController@newPasswordPost', 'middleware' => 'auth']);
    Route::get('settings/auth', ['as' => 'accounts.settings.oauth', 'uses' => 'AccountController@auth', 'middleware' => 'auth']);
    Route::post('settings/auth', ['as' => 'accounts.settings.oauthPost', 'uses' => 'AccountController@authPost', 'middleware' => 'auth']);
});
//--------------------------------------------------------------------------
//Message
Route::group(['prefix' => 'message'], function () {
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
Route::group(['prefix' => 'phpBB'], function () {
    Route::post('login/{forumName}', ['as' => 'phpBB.login', 'uses' => 'phpBBController@loginUser']);
    Route::post('register/{forumName}', ['as' => 'phpBB.register', 'uses' => 'phpBBController@registerUser', 'middleware' => 'auth']);

    // CSRF excepted
    Route::post('response/{id}', ['as' => 'phpBB.respond', 'uses' => 'phpBBController@externalResponse']);

    Route::get('redirect/{token}', ['as' => 'phpBB.redirect', 'uses' => 'phpBBController@redirected']);
});

//---------------------------------------------------------------------------------
// Api
Route::group(['prefix' => 'api'], function () {
    Route::get('getAuctionEndTime/{auctionid}', [
        'as' => 'api.getAuctionEndTime',
        'uses' => 'Markets\\auction\\timeController@getAuctionEndTimeJson'
    ]);
});