<?php namespace market\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as ControllerMarket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use market\core\market\event;
use market\core\market\marketPrepare;
use market\core\market\marketType;
use market\core\search\searchMarkets;
use market\helper\marketMenu;
use market\models\Market;
use DB;
use Session;
use Chromabits\Purifier\Contracts\Purifier;

class MarketsController extends ControllerMarket {
	
	/*
	|--------------------------------------------------------------------------
	| Market Controller
	|--------------------------------------------------------------------------
	|
	| Controller methods are called when a request enters the application
	| with their assigned URI. The URI a method responds to may be set
	| via simple annotations.
	|
	*/

    /**
     * @var Purifier
     */
    protected $purifier;

    protected $marketCommon;
    protected $request;

    /**
     * Construct an instance of MyClass
     *
     * @param Purifier $purifier
     */
    public function __construct(Purifier $purifier, marketType $marketType, Request $request) {
        // Inject dependencies
        $this->purifier = $purifier;
        $this->marketCommon = $marketType;
        $this->request = $request;
    }

	/**
	 * Display a listing of the resource.
	 * GET /markets
	 *
	 * @return Response
	 */
	public function index(marketPrepare $marketPrepare, searchMarkets $searchMarkets)
	{
//        dd('test MarketsController');

        $markets = $searchMarkets->getAll();
		$marketPrepare->addStuff($markets);

        $markets->setPath(route('markets.index'));

		return view('markets.index', [
            'markets' => $markets,
            'marketCommon' => $this->marketCommon
        ]);
	}

	public function filter(
        Request $request,
        searchMarkets $search,
        marketPrepare $marketPrepare
    )
	{
        $markets = $search->searchAdvanced();
        $marketPrepare->addStuff($markets);

        $markets->setPath(route('markets.filter'));
        $markets->appends($request->all());

		return view('markets.index', [
            'markets' => $markets,
            'marketCommon' => $this->marketCommon
        ]);
	}

    public function search(Request $request, marketPrepare $marketPrepare, searchMarkets $search)
    {
        //Search and add stuff to markets
        $searchTerm = $request->get('st');
        $markets = $search->searchSimple($searchTerm);
        $marketPrepare->addStuff($markets);
        //Set path for pagination
        $markets->setPath(route('markets.search'));
        $markets->appends(['st' => $searchTerm]);

        if($markets->count() <= 0)
        {
            session(['alert' => 'Inga resultat för "' . $searchTerm . '"']);
        }

        return view('markets.index', [
            'markets' => $markets,
            'marketCommon' => $this->marketCommon,
        ]);
    }

    public function sendPm($toUser, $title)
    {
        return view('account.message.new', ['reciever' => $toUser, 'title' => 'Angående: ' . $title]);
    }

}
