<?php namespace market\Http\Controllers;

use Illuminate\Routing\Controller as ControllerMarket;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use market\core\market\marketType;
use market\helper\auction;
use market\helper\buy;
use market\helper\debug;
use market\helper\market as markethelper;
use market\helper\marketEndReason;
use market\helper\marketCRUD;
use market\helper\marketMenu;
use market\helper\text;
use market\Http\Requests\CreateUpdateQuestionRequest;
use market\Http\Requests\MarketCreateUpdateRequest;
use market\models\Market;
use market\models\MarketQuestions;
use Illuminate\Http\Request;
use DB;
use Session;
use Chromabits\Purifier\Contracts\Purifier;
use HTMLPurifier_Config;
use market\helper\markets\common as marketCommon;

use Intervention\Image\ImageManagerStatic as Image;

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

    /**
     * Construct an instance of MyClass
     *
     * @param Purifier $purifier
     */
    public function __construct(Purifier $purifier, marketType $marketType) {
        // Inject dependencies
        $this->purifier = $purifier;
        $this->marketCommon = $marketType;
    }

	/**
	 * Display a listing of the resource.
	 * GET /markets
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		
        $auctionHelper = new \market\helper\markets\auction();

        $markets = Market::select()
            ->with('User')
            ->withoutBlockedMarkets()
            ->blockedSellerByUser()
            ->paginate(config('market.paginationNr'), 20);
        $markets->setPath(route('markets.index'));

        if(Auth::check())
		{
			//TODO::Sort non blocked markets for user
            marketMenu::addMarketMenuToMarkets($markets);
		}

        foreach($markets as $market)
        {
            $auctionHelper->setHighestBid($market);
        }

		return view('markets.index', [
            'markets' => $markets,
            'marketCommon' => $this->marketCommon
        ]);
	}

	public function filter()
	{
        //todo: if input is missing, get from flash, else use default 1
		// Begining of building db query
		$query = Market::select('*');

		// Remove deleted markets from query if box checked
		if(Input::has('ended'))
		{
			$query->withTrashed();
		}

//		// Add type af markets to query depending on which boxes are ticked
		$query->where(function($query) {


//			if (Input::has('saljes')) {
//				$query->orWhere('type', '=', 'saljes');
//			}

            foreach($this->marketCommon->getAllMarketTypes() as $key => $val)
            {
                if(Input::has('t' . $key))
                {
                    $query->orWhere('marketType', '=', $key);
                }
            }

		});

		if (Input::has('hiddenAds')) {
			//TODO: Check for hidden markets
		}

		if (Input::has('hiddenSellers')) {
			//TODO: Check for hidden sellers
		}

        //Query the db
		$temp = $query->paginate(config('market.paginationNr'), 20);
        $temp->setPath(route('markets.filter'));

		// add a menu to each market if user is logged in
		if(Auth::check())
		{
			foreach ($temp as $market)
			{
				marketMenu::addMarketMenu($market);
			}
		}

        //Why is this here?n To save user input when redirecting back...
		Input::flash();

		return view('markets.index', [
            'markets' => $temp,
            'marketCommon' => $this->marketCommon
        ]);
	}

    public function search()
    {
        $search = Input::get('s');
        if(isset($search)){

            //inspired by:
            //http://stackoverflow.com/questions/19612180/creating-search-functionality-with-laravel-4

			$query = Market::where('title', 'LIKE', '%' . $search . '%')
				->orWhere('description', 'LIKE', '%' . $search . '%');

            $result = $query->get();

			//Set menu for each market
			foreach ($result as $market)
			{
				marketMenu::addMarketMenu($market);
			}

            //TODO: Flash filter data

            return view('markets.index', ['markets' => $result]);
        }


        return 'Searchterm is missing';
    }

    public function sendPm($toUser, $title)
    {
        return view('account.message.new', ['reciever' => $toUser, 'title' => 'Angående: ' . $title]);
    }

}
