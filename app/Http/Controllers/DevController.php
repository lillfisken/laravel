<?php namespace market\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Queue;
use market\Commands\sendMailAuctionEnded;
use market\Commands\testQueue;
use market\core\mail\auctionEnded;
use market\helper\mailer;
use market\helper\time as timeHelper;
use market\Http\Requests;
use market\Http\Controllers\Controller;
use market\models\Market;
use market\models\User;
//use Request;
use Session;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Request;

class DevController extends Controller {

    protected $basePath = '/market/public/index.php/dev/';

    protected $functions = [
        'roadmap' => 'Roadmap',
        'info' => 'Php info',
        'url' => 'Last Url',
        'session' => 'DD full session',
        'auction-end-time/374' => 'auctionEndTime/374',
        'all-auctions' => 'DD all auctions',
        'current-timestamp' => 'Current time unix',
        'timer-test' => 'Timertest',
        'timer-void-test' => 'Test if void function blocks execution',
        'send-mail-new-bid' => 'Send mail by new bid',
        'route-list' => 'List all routes',
        'new-bid' => 'New bid on watched',
        'markets-without-blocked-sellers' => 'Get all market with blocked selelrs',
        'dd-request' => 'DD Request',
        'test-time' => 'Test time',
        'delete-auction-mail' => 'Test send mail ended auction',

    ];

    public function getIndex()
    {
        foreach($this->functions as $key => $value)
        {
            echo '<a href="' . $this->basePath . $key . '">' . $value . '</a><br/>';
        }
    }

    public function getInfo()
    {
        echo phpinfo();
    }

	public function getRoadmap()
	{
		return view('roadmap');
	}

	public function getUrl()
	{
	    $uri = Request::url();
		dd($uri);
	}

	public function getSession()
	{
		$session = Session::all();
		dd($session);
	}

    public function getAuctionEndTime($id)
    {
        $endtime = Market::select('end_at')
            ->where('marketType', 4)
            ->where('id', $id)
            ->first();

//        echo $endtime['end_at'];
//        echo $endtime;
//        dd($id, $endtime, $endtime['end_at']);
//        echo $endtime['end_at']->timestamp;
//        echo $endtime->end_at->timestamp;
//        dd($endtime['end_at']->timestamp);
//        return new JsonResponse($endtime);
//        return new JsonResponse(['end_at' => $endtime['end_at']]);
        return new JsonResponse(['end_at' => $endtime->end_at->timestamp]);
    }

    public function getCurrentTimestamp()
    {
        return new JsonResponse(['now', time()]);
    }

    public function getAllAuctions()
    {
//        dd('AllAuctions');
        dd(Market::where('marketType', 4)->get());
    }

    public function getTimerTest()
    {
        $start = microtime(true);
        sleep(3);
        $stop = microtime(true);

        dd($start, $stop, ($stop-$start));
    }

    public function getTimerVoidTest()
    {

        $start = microtime(true);
//        Queue::push(new testQueue('sending from dev'));
//        $test = new testAsync('async');
//        $test->start();
        sleep(1);
        $stop = microtime(true);
        sleep(3);
        echo 'Start: ' . $start . '<br/>';
        echo 'Stop: ' . $stop . '<br/>';
        echo 'Stop - Start: ' . ($stop - $start) . '<br/>';
        echo 'Now: ' . microtime(true) . '<br/>';
    }

    private function sleep()
    {
        sleep(3);
    }

    public function getSendMailNewBid()
    {
        $mailer = new mailer();
        $mailer->sendMailNewBidOnMyAuction(374, 4, 100);
        dd('sendMailNewBid');
    }

    public function getRouteList()
    {
        dd(Artisan::call('route:list'));
    }

    public function getNewBid(\market\core\watched\newBidOnWatched $newBidOnWatched)
    {
        $newBidOnWatched->newBid(2);
    }

    //	Route::get('/dev', function(){
//
//        echo '<a href="/market/public/index.php/dev/list">Visa lista &ouml;ver alla mappar och filer med dess beh&ouml;righeter i \'public\'</a><br/>';
//        echo '<a href="/market/public/index.php/dev/phpinfo">PhpInfo</a><br/>';
//        echo '<a href="/market/public/index.php/dev/apiTest">Send test request phpBB API</a></br>';
//        echo '<a href="/market/public/index.php/dev/enviroment">Enviroment</a></br>';
//        echo '<a href="/market/public/index.php/dev/show-autoloaders">Show autoloaders</a></br>';
//        echo '<a href="/market/public/index.php/dev/testAuctionHelper">Test AuctionHelper</a></br>';
//        echo '<a href="/market/public/index.php/dev/classmap">Class map</a></br>';
//        echo '<a href="/market/public/index.php/dev/testResponse">Test response</a></br>';
//        echo '<a href="/market/public/index.php/dev/endAuction">End auction</a></br>';
//        echo '<a href="/market/public/index.php/dev/ddAuction">dd auction</a></br>';
//    });
//    Route::get('dev/list', function(){
//        $root = '/home/saljdemo/market/';
//
//        //http://stackoverflow.com/questions/952263/deep-recursive-array-of-directory-structure-in-php
//
//        function fillArrayWithFileNodes( DirectoryIterator $dir )
//        {
//
//            $data = array();
//            foreach ( $dir as $node )
//            {
//                if ( $node->isDir() && !$node->isDot() )
//                {
//                    //http://php.net/manual/en/function.fileperms.php
//                    $perms = fileperms($dir->getPathname());
//
//                    if (($perms & 0xC000) == 0xC000) {
//                        // Socket
//                        $info = 's';
//                    } elseif (($perms & 0xA000) == 0xA000) {
//                        // Symbolic Link
//                        $info = 'l';
//                    } elseif (($perms & 0x8000) == 0x8000) {
//                        // Regular
//                        $info = '-';
//                    } elseif (($perms & 0x6000) == 0x6000) {
//                        // Block special
//                        $info = 'b';
//                    } elseif (($perms & 0x4000) == 0x4000) {
//                        // Directory
//                        $info = 'd';
//                    } elseif (($perms & 0x2000) == 0x2000) {
//                        // Character special
//                        $info = 'c';
//                    } elseif (($perms & 0x1000) == 0x1000) {
//                        // FIFO pipe
//                        $info = 'p';
//                    } else {
//                        // Unknown
//                        $info = 'u';
//                    }
//
//                    // Owner
//                    $info .= (($perms & 0x0100) ? 'r' : '-');
//                    $info .= (($perms & 0x0080) ? 'w' : '-');
//                    $info .= (($perms & 0x0040) ?
//                        (($perms & 0x0800) ? 's' : 'x' ) :
//                        (($perms & 0x0800) ? 'S' : '-'));
//
//                    // Group
//                    $info .= (($perms & 0x0020) ? 'r' : '-');
//                    $info .= (($perms & 0x0010) ? 'w' : '-');
//                    $info .= (($perms & 0x0008) ?
//                        (($perms & 0x0400) ? 's' : 'x' ) :
//                        (($perms & 0x0400) ? 'S' : '-'));
//
//                    // World
//                    $info .= (($perms & 0x0004) ? 'r' : '-');
//                    $info .= (($perms & 0x0002) ? 'w' : '-');
//                    $info .= (($perms & 0x0001) ?
//                        (($perms & 0x0200) ? 't' : 'x' ) :
//                        (($perms & 0x0200) ? 'T' : '-'));
//
//                    $data[$info . ' : ' . $node->getFilename()] = fillArrayWithFileNodes( new DirectoryIterator( $node->getPathname() ) );
//                }
//                else if ( $node->isFile() )
//                {
//                    //http://php.net/manual/en/function.fileperms.php
//                    $perms = fileperms($dir->getPathname());
//
//                    if (($perms & 0xC000) == 0xC000) {
//                        // Socket
//                        $info = 's';
//                    } elseif (($perms & 0xA000) == 0xA000) {
//                        // Symbolic Link
//                        $info = 'l';
//                    } elseif (($perms & 0x8000) == 0x8000) {
//                        // Regular
//                        $info = '-';
//                    } elseif (($perms & 0x6000) == 0x6000) {
//                        // Block special
//                        $info = 'b';
//                    } elseif (($perms & 0x4000) == 0x4000) {
//                        // Directory
//                        $info = 'd';
//                    } elseif (($perms & 0x2000) == 0x2000) {
//                        // Character special
//                        $info = 'c';
//                    } elseif (($perms & 0x1000) == 0x1000) {
//                        // FIFO pipe
//                        $info = 'p';
//                    } else {
//                        // Unknown
//                        $info = 'u';
//                    }
//
//                    // Owner
//                    $info .= (($perms & 0x0100) ? 'r' : '-');
//                    $info .= (($perms & 0x0080) ? 'w' : '-');
//                    $info .= (($perms & 0x0040) ?
//                        (($perms & 0x0800) ? 's' : 'x' ) :
//                        (($perms & 0x0800) ? 'S' : '-'));
//
//                    // Group
//                    $info .= (($perms & 0x0020) ? 'r' : '-');
//                    $info .= (($perms & 0x0010) ? 'w' : '-');
//                    $info .= (($perms & 0x0008) ?
//                        (($perms & 0x0400) ? 's' : 'x' ) :
//                        (($perms & 0x0400) ? 'S' : '-'));
//
//                    // World
//                    $info .= (($perms & 0x0004) ? 'r' : '-');
//                    $info .= (($perms & 0x0002) ? 'w' : '-');
//                    $info .= (($perms & 0x0001) ?
//                        (($perms & 0x0200) ? 't' : 'x' ) :
//                        (($perms & 0x0200) ? 'T' : '-'));
//
//                    //dd($dir->getPathname());
//                    $data[] = $info . ' : ' . $node->getFilename();
//                }
//            }
//            return $data;
//        }
//        $fileData = fillArrayWithFileNodes( new DirectoryIterator( $root ) );
//
//        dd($fileData);
//
////http://stackoverflow.com/questions/14304935/php-listing-all-directories-and-sub-directories-recursively-in-drop-down-menu
//        $iter = new RecursiveIteratorIterator(
//            new RecursiveDirectoryIterator($root, RecursiveDirectoryIterator::SKIP_DOTS),
//            RecursiveIteratorIterator::SELF_FIRST,
//            RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
//        );
//
//        $paths = array($root);
//        foreach ($iter as $path => $dir) {
//            if ($dir->isDir()) {
//                $paths[] = $path;
//            }
//        }
//
//        dd($paths);
//    });
//	Route::get('roadmap', ['as' => 'roadmap', 'uses' => 'DevController@road', 'middleware' => 'auth']);
//	Route::get('geturl', ['as' => 'geturl', 'uses' => 'DevController@getUrl', 'middleware' => 'auth']);
//	Route::get('session', ['as' => 'session', 'uses' => 'DevController@session', 'middleware' => 'auth']);
//    Route::get('dev/phpinfo', function(){
//        echo phpinfo();
//    });
//    Route::get('dev/apiTest', function(){
//        //Using Guzzle
//        $client = new Client();
//        $response = $client->get('http://elektro.coo/phpBB3/api/test');
//        $responseCode = $response->getStatusCode();
//        $json = $response->json();
//        dd($responseCode, $json);
//    });
//    Route::get('dev/enviroment', function(){
//       dd(gethostname(), App::environment(), $_ENV);
//    });
//    Route::get('dev/show-autoloaders', function(){
//        foreach(spl_autoload_functions() as $callback)
//        {
//            if(is_string($callback))
//            {
//                echo '- ',$callback,"\n<br>\n";
//            }
//
//            else if(is_array($callback))
//            {
//                if(is_object($callback[0]))
//                {
//                    echo '- ',get_class($callback[0]);
//                }
//                elseif(is_string($callback[0]))
//                {
//                    echo '- ',$callback[0];
//                }
//                echo '::',$callback[1],"\n<br>\n";
//            }
//            else
//            {
//                var_dump($callback);
//            }
//        }
//    });
//    Route::get('dev/testAuctionHelper', function(){
//
////        $require = '/home/saljdemo/market/app/helper/markets/auction.php';
////        $require = getcwd() . '/../app/helper/markets/auction.php';
////        $required = include_once($require);
//
//        dd(
//            '$require',
////            $require,
//            '$required',
////            $required,
//            "class_exists('market\helper\markets\auction')",
//            class_exists('market\helper\markets\auction', false),
//            "class_exists('market\helper\markets\auction', false)",
//            class_exists('market\helper\markets\auction'),
//            "base_path('market\helper')",
//            base_path('market/helper')
//        );
//
//        $auction = new auction();
//
//        dd($auction);
//    });
//    Route::get('dev/classmap', function(){
//
//        dd(spl_classes(), get_declared_classes());
//        //Thanks to: http://stackoverflow.com/questions/22761554/php-get-all-class-names-inside-a-particular-namespace/27207776#27207776
//        $namespace = 'market\helper\markets';
//
//// Relative namespace path
//        $namespaceRelativePath = str_replace('\\', DIRECTORY_SEPARATOR, $namespace);
//
//// Include paths
//        $includePathStr = get_include_path();
//        $includePathArr = explode(PATH_SEPARATOR, $includePathStr);
//
//// Iterate include paths
//        $classArr = array();
//        foreach ($includePathArr as $includePath) {
//            $path = $includePath . DIRECTORY_SEPARATOR . $namespaceRelativePath;
//            if (is_dir($path)) { // Does path exist?
//                $dir = dir($path); // Dir handle
//                while (false !== ($item = $dir->read())) {  // Read next item in dir
//                    $matches = array();
//                    if (preg_match('/^(?<class>[^.].+)\.php$/', $item, $matches)) {
//                        $classArr[] = $matches['class'];
//                    }
//                }
//                $dir->close();
//            }
//        }
//
//        dd($namespace,$includePathArr, $classArr, get_include_path());
//
//// Debug output
//        var_dump($includePathArr);
//        var_dump($classArr);
//    });
//
//    Route::get('dev/testResponse', function() {
//
////        dd(response()->json(['name' => 'Abigail', 'state' => 'CA']));
//
////        $url = Laracurl::buildUrl('http://www.google.com', ['s' => 'curl']);
////        $url = Laracurl::buildUrl('http://elektro.coo/market/public/index.php/dev/getResponse', []);
////        $url = Laracurl::buildUrl('http://elektro.coo/market/public/index.php/auth/forgotPassword', []);
////        $response = Laracurl::post($url);
//        $response = Laracurl::post('http://elektro.coo/market/public/index.php/dev/getResponse');
////        $response = Laracurl::post('http://postcatcher.in/catchers/55bfba8939d86f0300001115');
//
//
//
////
////        $client = new GuzzleHttp\Client();
////        $response = $client->post('http://elektro.coo/market/public/index.php/dev/getResponse');
//        dd('Test response', $response->statusText, $response);
//
//    });
//
//    Route::post('dev/getResponse', function() {
////        return response()->json(['name' => 'Abigail', 'state' => 'CA']);
//
////        dd('bguyvfcjsxzmkl');
//        return 'return get response';
//////        echo ('echo get response');
////        dd('getResponse');
//    });
//
//    Route::get('dev/endAuction', function() {
//        $auction = \market\Market::where('marketType', 4)
//            ->where('endingAt', '<', time())
//            ->delete();
//
//        dd($auction);
//    });
//
//    Route::get('dev/ddAuction', function() {
//        $auction = \market\Market::where('marketType', 4)
//            ->get();
//
//        dd($auction);
//    });

    public function getMarketsWithoutBlockedSellers(Market $market)
    {
//        $marketCount = Market::all()->count();
        echo 'User id: ' . Auth::id();

        $markets2 = Market::whereDoesntHave('user.blockedUsers')
            ->get();

//        $authId = Auth::id();

//        $temp = $market->whereDoesntHave('blockedByUser', function($query) use($authId) {
//            $query->where('blockingUserId', '=', $authId);
//        })
//        ->get();
//        dd($temp);

        $markets = Market::blockedByUser()->get();
//            with('user.blockedUsers')
//            whereDoesntHave('user.blockedUsers', function($query) use ($market, $authId) {
//                $query
////                    ->where('blockedUserId', '=', $market->createdByUser);
////                    ->where('blockingUserId', '=', $authId)
//                    ->where('blockedUserId', '=', '2');
//                    ;
//            })
//            ->get();
//        dd($markets, $markets[10]->user->blockedUsers, Market::all()->count(), $market->createdByUser);
//        dd($markets);
        $marketsAll = Market::with('user.blockedUsers')->get();

        $marketBlockedCount = Market::withoutBlockedSellers()->get();

        echo '<table border="1">';
        echo '<tr>
                <th>Count ' . $marketsAll->count() . '</th>
                <th>markets2 ' . $markets2->count() . '</th>
                <th>markets ' . $markets->count() . '</th>
                <th>marketsAll ' . $marketsAll->count() . '</th>
                <th>marketBlockedCount ' . $marketBlockedCount->count() . '</th>
              </tr>';

        for($i = 0; $marketsAll->count() > $i ; $i++)
        {
//            dd($marketsAll->count(), $i);

            echo '<tr>';
                echo '<td>' . $i . '</td>';

                $id = isset($markets2[$i]) ? $markets2[$i]->id : '---';
                echo '<td>' . $id . '</td>';

                $id = isset($markets[$i]) ? $markets[$i]->id : '---';
                echo '<td>' . $id . '</td>';

                $id = isset($marketsAll[$i]) ? $marketsAll[$i]->id : '---';
                $blocked = isset($marketsAll[$i]->user->blockedUser)
                    ? $marketsAll[$i]->user->blockedUser->blockedUserId
                    : '---';
                echo '<td>' . $id . ' : ' . $blocked .'</td>';

                $id = isset($marketBlockedCount[$i]) ? $marketBlockedCount[$i]->id : '---';
                echo '<td>' . $id . '</td>';
            echo '</tr>';
        }
        echo '</table>';

        dd('getMarketsWithoutBlockedSellers',
//            'Blocked: ' . $marketBlockedCount,
//            'Non blocked '.  $marketCount
            Auth::id(),
//            $markets2,
//            $markets,
            $marketsAll,
            $marketsAll[10]->user
//            $marketBlockedCount
        );
    }

    public function getDdRequest(Request $request)
    {
        dd($request);
    }

    public function getTestTime()
    {
        $time = new timeHelper();
        $carbon = Carbon::createFromTimestamp(time());
        echo $carbon;
        echo '<br/>';
        $testTime = Carbon::createFromTimestamp(time());

        echo 'Test time<br/><br/>';
        echo '2015-11-23 22:11:00 < ' . $testTime . ' = ' . ('2015-11-23 22:11:00' < $testTime) . '<br/>';
        echo '2015-11-23 22:11:00 > ' . $testTime . ' = ' . ('2015-11-23 22:11:00' > $testTime) . '<br/><br/>';
        echo '2016-11-23 22:11:00 < ' . $testTime . ' = ' . ('2016-11-23 22:11:00' < $testTime) . '<br/>';
        echo '2016-11-23 22:11:00 > ' . $testTime . ' = ' . ('2016-11-23 22:11:00' > $testTime) . '<br/>';

        echo '<br/>2015-11-23 22:11:00<br/>';
        if(('2015-11-23 22:11:00' < $testTime))
        {
            echo 'End at is smaller than now<br/>';
        }
        else
        {
            echo 'End at is bigger than now<br/>';
        }

        if(('2015-11-23 22:11:00' > $testTime))
        {
            echo 'End at is bigger than now<br/>';
        }
        else
        {
            echo 'End at is smaller than now<br/>';
        }

        echo '<br/>2016-12-23 22:11:00<br/>';
        if(('2016-12-23 22:11:00' < $testTime))
        {
            echo 'End at is smaller than now<br/>';
        }
        else
        {
            echo 'End at is bigger than now<br/>';
        }

        if(('2016-12-23 22:11:00' > $testTime))
        {
            echo 'End at is bigger than now<br/>';
        }
        else
        {
            echo 'End at is smaller than now<br/>';
        }
    }

    public function getDeleteAuctionMail()
    {
        Queue::push(new sendMailAuctionEnded(54));
        Queue::push(new sendMailAuctionEnded(14));
        dd('Hubba bubba smurfen spökar');

        $mail = new auctionEnded(54);
        $mail->sendMailToOwner();
        $mail->sendMailToWinner();
        $mail->sendMailToWatchers();

        $mail2 = new auctionEnded(14);
        $mail2->sendMailToOwner();
        $mail2->sendMailToWinner();
        $mail2->sendMailToWatchers();

        dd('Mail 1: ', $mail, 'Mail 2: ', $mail2);
    }
}