<?php

//--------------------------------------------------------------------------

//region Model Binding

//TODO:Create model bindning and alter controllers
//http://laravel.com/docs/master/routing#route-model-binding
Route::model('market', 'market\Market');
Route::bind('user', function($username)
{
//	dd($username);
//    dd(market\User::where('username', '=', $username)->firstOrFail());
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
Route::post('markets', ['as' => 'markets.store', 'uses' => 'MarketsController@store']);
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

if(Config::get('app.debug') === 'true')
{
	Route::get('/dev', function(){

        echo '<a href="/market/public/index.php/dev/list">Visa lista &ouml;ver alla mappar och filer med dess beh&ouml;righeter i \'public\'</a>';
	});
    Route::get('dev/list', function(){
        $root = '/var/www/market/public';

        //http://stackoverflow.com/questions/952263/deep-recursive-array-of-directory-structure-in-php

        function fillArrayWithFileNodes( DirectoryIterator $dir )
        {

            $data = array();
            foreach ( $dir as $node )
            {
                if ( $node->isDir() && !$node->isDot() )
                {
                    //http://php.net/manual/en/function.fileperms.php
                    $perms = fileperms($dir->getPathname());

                    if (($perms & 0xC000) == 0xC000) {
                        // Socket
                        $info = 's';
                    } elseif (($perms & 0xA000) == 0xA000) {
                        // Symbolic Link
                        $info = 'l';
                    } elseif (($perms & 0x8000) == 0x8000) {
                        // Regular
                        $info = '-';
                    } elseif (($perms & 0x6000) == 0x6000) {
                        // Block special
                        $info = 'b';
                    } elseif (($perms & 0x4000) == 0x4000) {
                        // Directory
                        $info = 'd';
                    } elseif (($perms & 0x2000) == 0x2000) {
                        // Character special
                        $info = 'c';
                    } elseif (($perms & 0x1000) == 0x1000) {
                        // FIFO pipe
                        $info = 'p';
                    } else {
                        // Unknown
                        $info = 'u';
                    }

                    // Owner
                    $info .= (($perms & 0x0100) ? 'r' : '-');
                    $info .= (($perms & 0x0080) ? 'w' : '-');
                    $info .= (($perms & 0x0040) ?
                        (($perms & 0x0800) ? 's' : 'x' ) :
                        (($perms & 0x0800) ? 'S' : '-'));

                    // Group
                    $info .= (($perms & 0x0020) ? 'r' : '-');
                    $info .= (($perms & 0x0010) ? 'w' : '-');
                    $info .= (($perms & 0x0008) ?
                        (($perms & 0x0400) ? 's' : 'x' ) :
                        (($perms & 0x0400) ? 'S' : '-'));

                    // World
                    $info .= (($perms & 0x0004) ? 'r' : '-');
                    $info .= (($perms & 0x0002) ? 'w' : '-');
                    $info .= (($perms & 0x0001) ?
                        (($perms & 0x0200) ? 't' : 'x' ) :
                        (($perms & 0x0200) ? 'T' : '-'));

                    $data[$info . ' : ' . $node->getFilename()] = fillArrayWithFileNodes( new DirectoryIterator( $node->getPathname() ) );
                }
                else if ( $node->isFile() )
                {
                    //http://php.net/manual/en/function.fileperms.php
                    $perms = fileperms($dir->getPathname());

                    if (($perms & 0xC000) == 0xC000) {
                        // Socket
                        $info = 's';
                    } elseif (($perms & 0xA000) == 0xA000) {
                        // Symbolic Link
                        $info = 'l';
                    } elseif (($perms & 0x8000) == 0x8000) {
                        // Regular
                        $info = '-';
                    } elseif (($perms & 0x6000) == 0x6000) {
                        // Block special
                        $info = 'b';
                    } elseif (($perms & 0x4000) == 0x4000) {
                        // Directory
                        $info = 'd';
                    } elseif (($perms & 0x2000) == 0x2000) {
                        // Character special
                        $info = 'c';
                    } elseif (($perms & 0x1000) == 0x1000) {
                        // FIFO pipe
                        $info = 'p';
                    } else {
                        // Unknown
                        $info = 'u';
                    }

                    // Owner
                    $info .= (($perms & 0x0100) ? 'r' : '-');
                    $info .= (($perms & 0x0080) ? 'w' : '-');
                    $info .= (($perms & 0x0040) ?
                        (($perms & 0x0800) ? 's' : 'x' ) :
                        (($perms & 0x0800) ? 'S' : '-'));

                    // Group
                    $info .= (($perms & 0x0020) ? 'r' : '-');
                    $info .= (($perms & 0x0010) ? 'w' : '-');
                    $info .= (($perms & 0x0008) ?
                        (($perms & 0x0400) ? 's' : 'x' ) :
                        (($perms & 0x0400) ? 'S' : '-'));

                    // World
                    $info .= (($perms & 0x0004) ? 'r' : '-');
                    $info .= (($perms & 0x0002) ? 'w' : '-');
                    $info .= (($perms & 0x0001) ?
                        (($perms & 0x0200) ? 't' : 'x' ) :
                        (($perms & 0x0200) ? 'T' : '-'));

                    //dd($dir->getPathname());
                    $data[] = $info . ' : ' . $node->getFilename();
                }
            }
            return $data;
        }
        $fileData = fillArrayWithFileNodes( new DirectoryIterator( $root ) );

        dd($fileData);

//http://stackoverflow.com/questions/14304935/php-listing-all-directories-and-sub-directories-recursively-in-drop-down-menu
        $iter = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($root, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST,
            RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
        );

        $paths = array($root);
        foreach ($iter as $path => $dir) {
            if ($dir->isDir()) {
                $paths[] = $path;
            }
        }

        dd($paths);
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

//TODO: Alter route to not use user if not neccesarey
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

Route::get('profile/settings/show', ['as' => 'accounts.settings.settings', 'uses' => 'AccountController@settings', 'middleware' => 'auth']);
Route::post('profile/settings/', ['as' => 'accounts.settings.save', 'uses' => 'AccountController@saveSettings', 'middleware' => 'auth']);
Route::get('profile/settings/password', ['as' => 'accounts.settings.password', 'uses' => 'AccountController@newPassword', 'middleware' => 'auth']);
Route::post('profile/settings/password', ['as' => 'accounts.settings.passwordPost', 'uses' => 'AccountController@newPasswordPost', 'middleware' => 'auth']);
Route::get('profile/settings/oauth', ['as' => 'accounts.settings.oauth', 'uses' => 'AccountController@oauth', 'middleware' => 'auth']);
Route::post('profile/settings/oauth', ['as' => 'accounts.settings.oauthPost', 'uses' => 'AccountController@oathPost', 'middleware' => 'auth']);


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
