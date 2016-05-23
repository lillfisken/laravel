<?php namespace market\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Queue;
use market\Commands\sendMailAuctionEnded;
use market\core\mail\auctionEnded;
use market\core\market\marketPrepare;
use market\core\market\marketType;
use market\core\search\searchMarkets;
use market\Http\Requests;
use market\Jobs\endOldAuction;
use market\models\Conversation;
use market\models\Market;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Request;

class DevController extends Controller
{

    protected $search;
    protected $marketCommon;

    public function __construct(searchMarkets $searchMarkets, marketType $marketType)
    {
        $this->search = $searchMarkets;
        $this->marketCommon = $marketType;
    }
    protected $basePath = '/market/public/index.php/dev/';

    protected $functions = [
        'roadmap' => 'Roadmap',
        'info' => 'Php info',
        'test-sendmail' => 'Test sendMailToWatchersOnMarketWhenNewBidIsPlaced',
        'reset-auctions' => 'Set some auctions to non deleted',
        'dev-view' => 'Dev view',
    ];

    public function getTestSendmail()
    {
        $test = new endOldAuction();
        $test->handle();
        dd('test sendMailToWatchersOnMarketWhenNewBidIsPlaced', $test);
    }

    public function getResetAuctions()
    {
        $markets = Market::onlyTrashed()->where('marketType', 4)->limit(150)->restore();
//        foreach(marke)
        dd('hej', $markets);
    }


    public function getIndex()
    {
        foreach ($this->functions as $key => $value) {
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

    public function getDevView(marketPrepare $marketPrepare)
    {
        $market = $this->search->getAll();
        $marketPrepare->addStuff($market);

        return view('dev.markets.index', [
            'markets' => $market,
            'marketCommon' => $this->marketCommon,
        ]);
    }
}