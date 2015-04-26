<?php

//--------------------------------------------------------------------------

//region Model Binding

//TODO:Create model bindning and alter controllers
//http://laravel.com/docs/master/routing#route-model-binding
use Illuminate\Support\Facades\Route;

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
Route::get('/', 'MarketsController@index');
Route::group(['prefix'=>'market'], function(){
    Route::get('/', ['as' => 'markets.index', 'uses' => 'MarketsController@index']);
    Route::get('filter', ['as' => 'markets.filter', 'uses' => 'MarketsController@filter'] );
    Route::get('create', ['as' => 'markets.create', 'uses' => 'MarketsController@create', 'middleware' => 'auth']);
    Route::get('{market}', ['as' => 'markets.reactivate', 'uses' => 'MarketsController@reactivate', 'middleware' => 'auth']);
    Route::post('/', ['as' => 'markets.store', 'uses' => 'MarketsController@store']);
    Route::get('{markets}', ['as' => 'markets.show', 'uses' => 'MarketsController@show']);
    Route::get('{markets}/edit', ['as' => 'markets.edit', 'uses' => 'MarketsController@edit', 'middleware' => 'auth']);
    Route::patch('{markets}', ['as' => 'markets.update', 'uses' => 'MarketsController@update', 'middleware' => 'auth']);
    Route::get('delete/{market}', ['as' => 'markets.delete', 'uses' => 'MarketsController@delete', 'middleware' => 'auth']);
    Route::delete('/', ['as' => 'markets.destroy', 'uses' => 'MarketsController@destroy', 'middleware' => 'auth']);
    Route::get('search', ['as' => 'markets.search', 'uses' => 'MarketsController@search']);
    Route::post('question', ['as' => 'markets.question', 'uses' => 'MarketsController@question', 'middleware' => 'auth']);
    Route::get('pm/{title}/{toUser}', ['as' => 'markets.pm', 'uses' => 'MarketsController@sendPm', 'middleware' => 'auth']);

});
//--------------------------------------------------------------------------
if(Config::get('app.debug') === 'true')
{
	Route::get('/dev', function(){

        echo '<a href="/market/public/index.php/dev/list">Visa lista &ouml;ver alla mappar och filer med dess beh&ouml;righeter i \'public\'</a><br/>';
        echo '<a href="/market/public/index.php/dev/phpinfo">PhpInfo</a>';

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
    Route::get('dev/phpinfo', function(){
        echo phpinfo();
    });
}
//-----------------------------------------------------------------------------
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

Route::controller('oauth', 'Auth\OAuthController');
//--------------------------------------------------------------------------
Route::group(['prefix'=>'profile'], function(){
    //TODO: Alter route to not use user if not neccesarey
    Route::get('{user}', ['as' => 'accounts.profile', 'uses' => 'AccountController@show', 'middleware' => 'auth']);
    Route::get('blockmarket/{market}', ['as' => 'accounts.blockMarket', 'uses' => 'AccountController@blockMarket', 'middleware' => 'auth']);
    Route::get('unblockmarket/{market}', ['as' => 'accounts.unblockMarket', 'uses' => 'AccountController@unblockMarket', 'middleware' => 'auth']);
    Route::get('blockseller/{user}', ['as' => 'accounts.blockSeller', 'uses' => 'AccountController@blockSeller', 'middleware' => 'auth']);
    Route::get('unblockseller/{user}', ['as' => 'accounts.unblockSeller', 'uses' => 'AccountController@unblockSeller', 'middleware' => 'auth']);

    Route::get('watched/{user}', ['as' => 'accounts.watched', 'uses' => 'AccountController@watched', 'middleware' => 'auth']);
    Route::get('active/{user}', ['as' => 'accounts.active', 'uses' => 'AccountController@active', 'middleware' => 'auth']);
    Route::get('trashed/{user}', ['as' => 'accounts.trashed', 'uses' => 'AccountController@trashed', 'middleware' => 'auth']);
    Route::get('blockedmarket/{user}', ['as' => 'accounts.blockedmarket', 'uses' => 'AccountController@blockedmarket', 'middleware' => 'auth']);
    Route::get('blockedseller/{user}', ['as' => 'accounts.blockedseller', 'uses' => 'AccountController@blockedseller', 'middleware' => 'auth']);

    Route::get('settings/show', ['as' => 'accounts.settings.settings', 'uses' => 'AccountController@settings', 'middleware' => 'auth']);
    Route::post('settings/', ['as' => 'accounts.settings.save', 'uses' => 'AccountController@saveSettings', 'middleware' => 'auth']);
    Route::get('settings/password', ['as' => 'accounts.settings.password', 'uses' => 'AccountController@newPassword', 'middleware' => 'auth']);
    Route::post('settings/password', ['as' => 'accounts.settings.passwordPost', 'uses' => 'AccountController@newPasswordPost', 'middleware' => 'auth']);
    Route::get('settings/oauth', ['as' => 'accounts.settings.oauth', 'uses' => 'AccountController@oauth', 'middleware' => 'auth']);
    Route::post('settings/oauth', ['as' => 'accounts.settings.oauthPost', 'uses' => 'AccountController@oathPost', 'middleware' => 'auth']);
});
//--------------------------------------------------------------------------
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
