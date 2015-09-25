<?php

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
	 return market\User::where('username', '=', $username)->firstOrFail();
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

//change
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
//    Route::get('{markets}/edit', ['as' => 'auction.edit', 'uses' =>  $controller . '@edit', 'middleware' => 'auth']);
//    Route::patch('{markets}', ['as' => 'auction.update.patch', 'uses' =>  $controller . '@update', 'middleware' => 'auth']);
    Route::get('bids/{markets}', ['as' => 'auction.bids', 'uses' =>  $controller . '@showAllBids', 'middleware' => 'auth']);

});

//auction
//Route::group(['prefix' => 'auction'], function(){
//    $controller = 'MarketAuctionController';
//
//    Route::get('/update/{id}', ['as' => 'auction.update', 'uses' =>  $controller . '@updateForm', 'middleware' => 'auth']);
//    Route::post('/update', ['as' => 'auction.update.store', 'uses' =>  $controller . '@update', 'middleware' => 'auth']);
//
//    Route::get('show/{id}', ['as'=>'auction.show', 'uses'=> $controller . '@show']);
//    Route::get('/', ['as' => 'auction.create', 'uses' => $controller . '@createForm', 'middleware' => 'auth']);
//    Route::post('/', ['as' => 'auction.store', 'uses' => $controller . '@create', 'middleware' => 'auth']);
//
//    Route::post('placebid', ['as' => 'auction.placeBid', 'uses' =>  $controller . '@placeBid', 'middleware' => 'auth']);
////    Route::get('{markets}/edit', ['as' => 'auction.edit', 'uses' =>  $controller . '@edit', 'middleware' => 'auth']);
////    Route::patch('{markets}', ['as' => 'auction.update.patch', 'uses' =>  $controller . '@update', 'middleware' => 'auth']);
//    Route::get('bids/{markets}', ['as' => 'auction.bids', 'uses' =>  $controller . '@showAllBids', 'middleware' => 'auth']);
//
//    Route::get('delete/{market}', ['as' => 'auction.destroy.get', 'uses' =>  $controller . '@destroyGet', 'middleware' => 'auth']);
//    Route::delete('delete', ['as' => 'auction.destroy.post', 'uses' =>  $controller . '@destroyPost', 'middleware' => 'auth']);
//});

//--------------------------------------------------------------------------
if(Config::get('app.debug') == 'true')
{
	Route::get('/dev', function(){

        echo '<a href="/market/public/index.php/dev/list">Visa lista &ouml;ver alla mappar och filer med dess beh&ouml;righeter i \'public\'</a><br/>';
        echo '<a href="/market/public/index.php/dev/phpinfo">PhpInfo</a><br/>';
        echo '<a href="/market/public/index.php/dev/apiTest">Send test request phpBB API</a></br>';
        echo '<a href="/market/public/index.php/dev/enviroment">Enviroment</a></br>';
        echo '<a href="/market/public/index.php/dev/show-autoloaders">Show autoloaders</a></br>';
        echo '<a href="/market/public/index.php/dev/testAuctionHelper">Test AuctionHelper</a></br>';
        echo '<a href="/market/public/index.php/dev/classmap">Class map</a></br>';
        echo '<a href="/market/public/index.php/dev/testResponse">Test response</a></br>';


    });
    Route::get('dev/list', function(){
        $root = '/home/saljdemo/market/';

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
    Route::get('dev/apiTest', function(){
        //Using Guzzle
        $client = new Client();
        $response = $client->get('http://elektro.coo/phpBB3/api/test');
        $responseCode = $response->getStatusCode();
        $json = $response->json();
        dd($responseCode, $json);
    });
    Route::get('dev/enviroment', function(){
       dd(gethostname(), App::environment(), $_ENV);
    });
    Route::get('dev/show-autoloaders', function(){
        foreach(spl_autoload_functions() as $callback)
        {
            if(is_string($callback))
            {
                echo '- ',$callback,"\n<br>\n";
            }

            else if(is_array($callback))
            {
                if(is_object($callback[0]))
                {
                    echo '- ',get_class($callback[0]);
                }
                elseif(is_string($callback[0]))
                {
                    echo '- ',$callback[0];
                }
                echo '::',$callback[1],"\n<br>\n";
            }
            else
            {
                var_dump($callback);
            }
        }
    });
    Route::get('dev/testAuctionHelper', function(){

//        $require = '/home/saljdemo/market/app/helper/markets/auction.php';
//        $require = getcwd() . '/../app/helper/markets/auction.php';
//        $required = include_once($require);

        dd(
            '$require',
//            $require,
            '$required',
//            $required,
            "class_exists('market\helper\markets\auction')",
            class_exists('market\helper\markets\auction', false),
            "class_exists('market\helper\markets\auction', false)",
            class_exists('market\helper\markets\auction'),
            "base_path('market\helper')",
            base_path('market/helper')
        );

        $auction = new auction();

        dd($auction);
    });
    Route::get('dev/classmap', function(){

        dd(spl_classes(), get_declared_classes());
        //Thanks to: http://stackoverflow.com/questions/22761554/php-get-all-class-names-inside-a-particular-namespace/27207776#27207776
        $namespace = 'market\helper\markets';

// Relative namespace path
        $namespaceRelativePath = str_replace('\\', DIRECTORY_SEPARATOR, $namespace);

// Include paths
        $includePathStr = get_include_path();
        $includePathArr = explode(PATH_SEPARATOR, $includePathStr);

// Iterate include paths
        $classArr = array();
        foreach ($includePathArr as $includePath) {
            $path = $includePath . DIRECTORY_SEPARATOR . $namespaceRelativePath;
            if (is_dir($path)) { // Does path exist?
                $dir = dir($path); // Dir handle
                while (false !== ($item = $dir->read())) {  // Read next item in dir
                    $matches = array();
                    if (preg_match('/^(?<class>[^.].+)\.php$/', $item, $matches)) {
                        $classArr[] = $matches['class'];
                    }
                }
                $dir->close();
            }
        }

        dd($namespace,$includePathArr, $classArr, get_include_path());

// Debug output
        var_dump($includePathArr);
        var_dump($classArr);
    });

    Route::get('dev/testResponse', function() {

//        dd(response()->json(['name' => 'Abigail', 'state' => 'CA']));

//        $url = Laracurl::buildUrl('http://www.google.com', ['s' => 'curl']);
//        $url = Laracurl::buildUrl('http://elektro.coo/market/public/index.php/dev/getResponse', []);
//        $url = Laracurl::buildUrl('http://elektro.coo/market/public/index.php/auth/forgotPassword', []);
//        $response = Laracurl::post($url);
        $response = Laracurl::post('http://elektro.coo/market/public/index.php/dev/getResponse');
//        $response = Laracurl::post('http://postcatcher.in/catchers/55bfba8939d86f0300001115');



//
//        $client = new GuzzleHttp\Client();
//        $response = $client->post('http://elektro.coo/market/public/index.php/dev/getResponse');
        dd('Test response', $response->statusText, $response);

    });

    Route::post('dev/getResponse', function() {
//        return response()->json(['name' => 'Abigail', 'state' => 'CA']);

//        dd('bguyvfcjsxzmkl');
        return 'return get response';
////        echo ('echo get response');
//        dd('getResponse');
    });


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
    Route::get('blockmarket/{market}', ['as' => 'accounts.blockMarket', 'uses' => 'AccountController@blockMarket', 'middleware' => 'auth']);
    Route::get('unblockmarket/{market}', ['as' => 'accounts.unblockMarket', 'uses' => 'AccountController@unblockMarket', 'middleware' => 'auth']);
    Route::get('blockseller/{user}', ['as' => 'accounts.blockSeller', 'uses' => 'AccountController@blockSeller', 'middleware' => 'auth']);
    Route::get('unblockseller/{user}', ['as' => 'accounts.unblockSeller', 'uses' => 'AccountController@unblockSeller', 'middleware' => 'auth']);

    Route::get('watched/{user}', ['as' => 'accounts.watched', 'uses' => 'AccountController@watched', 'middleware' => 'auth']);
    Route::get('active', ['as' => 'accounts.active', 'uses' => 'AccountController@active', 'middleware' => 'auth']);
    Route::get('inactive', ['as' => 'accounts.trashed', 'uses' => 'AccountController@trashed', 'middleware' => 'auth']);
    Route::get('blockedmarket/{user}', ['as' => 'accounts.blockedmarket', 'uses' => 'AccountController@blockedmarket', 'middleware' => 'auth']);
    Route::get('blockedseller/{user}', ['as' => 'accounts.blockedseller', 'uses' => 'AccountController@blockedseller', 'middleware' => 'auth']);

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

//http://elektro.coo/market/public/phpBB/response/Z9Ly9tlgWeRrLnYTmXhJ2JAdw4semzvat8JaWAthvb3rgmGw3AZIy3kUb6eo2RstVmDi9dq1IlAkKKYRuLV6PxU8ngEhMVfVrIIy6L0i4ZbZyEF7pkssuXt7XYqfqO5dldCpKvQBIQNHhbjLMVcotgIcn53XaOQh1Ii76BpzmpCWwPojGB1RfCxVTYJ7x7FtWSpTvH2J7hBkcXaJCTjQt66V8Sg9auvFfiGiUBv9FqHZc13TFbnz5ENuw345pm1