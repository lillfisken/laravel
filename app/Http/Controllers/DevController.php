<?php namespace market\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Queue;
use market\Commands\sendMailAuctionEnded;
use market\core\mail\auctionEnded;
use market\Http\Requests;
use market\Jobs\endOldAuction;
use market\models\Conversation;
use market\models\Market;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Request;

class DevController extends Controller
{

    protected $basePath = '/market/public/index.php/dev/';

    protected $functions = [
        'roadmap' => 'Roadmap',
        'info' => 'Php info',
        'test-sendmail' => 'Test sendMailToWatchersOnMarketWhenNewBidIsPlaced',
        'reset-auctions' => 'Set some auctions to non deleted'
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
}