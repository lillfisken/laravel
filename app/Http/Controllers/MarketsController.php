<?php namespace market\Http\Controllers;

use Illuminate\Routing\Controller as ControllerMarket;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
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
use market\Market;
use market\MarketQuestions;
use Illuminate\Http\Request;
use Input;
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

//    protected $auctionHelper;
//    protected $buyHelper;

    /**
     * Construct an instance of MyClass
     *
     * @param Purifier $purifier
     */
    public function __construct(Purifier $purifier) {
        // Inject dependencies
        $this->purifier = $purifier;
        $this->marketCommon = new marketCommon();

//        $this->auctionHelper = new auction();
//        $this->buyHelper = new buy();
    }

	
	/**
	 * Display a listing of the resource.
	 * GET /markets
	 *
	 * @return Response
	 */
	public function index()
	{
        $auctionHelper = new \market\helper\markets\auction();
//        dd('index', Auth::id(), Auth::check());

        $markets = Market::select()
            ->with('User')
            ->paginate(config('market.paginationNr'), 20);
        $markets->setPath(route('markets.index'));

        if(Auth::check())
		{
			//TODO::Sort non blocked markets for user
			//Get all markets from db

//			$temp = Market::select()->with('User')->get();
//			$temp = Market::select()
//                ->with('User')
//                ->paginate(config('market.paginationNr'), 20);
//            $temp->setPath(route('markets.index'));

            $sellHelper = new \market\helper\markets\sell();
            $buyHelper = new \market\helper\markets\buy();
            $changeHelper = new \market\helper\markets\change();
            $giveawayHelper = new \market\helper\markets\giveaway();

			//Set menu for each market
			foreach ($markets as $market)
			{
                //TODO: Different menus for different market types
                switch($market->marketType)
                {
                    case 0:
                        // 0 = wish to sell
                        $sellHelper->addMarketMenu($market);
                        break;
                    case 1:
                        // 1 = wish to buy
                        $buyHelper->addMarketMenu($market);
                        break;
                    case 2:
                        // 2 = wish to change
                        $changeHelper->addMarketMenu($market);
                        break;
                    case 3:
                        // 3 = wish to giveaway
                        $giveawayHelper->addMarketMenu($market);
                        break;
                    case 4:
                        // 4 = auction
                        $auctionHelper->addMarketMenu($market);
                        break;
//                    case 5:
//                        // 5 = wish to ???
//                        $???Helper->addMarketMenu($market);
//                        break;
                }
			}
		}
//		else {
////            dd('else');
//			$temp = Market::select('*')->paginate(config('market.paginationNr'), 20);
////            $temp = Market::all();
////            dd('else', $temp);
//        }

        foreach($markets as $market)
        {
            $auctionHelper->setHighestBid($market);
        }
        //TODO: add highest bid
//        dd($markets);

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
		$temp = $query->paginate(5);
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
				marketCRUD::addMarketMenu($market);
			}

            return view('markets.index', ['markets' => $result]);
        }


        return 'Searchterm is missing';
    }

    public function sendPm($toUser, $title)
    {
        return view('account.message.new', ['reciever' => $toUser, 'title' => 'Angående: ' . $title]);
    }

    public function question(CreateUpdateQuestionRequest $request)
    {
        //TODO::Add validation, questionRequest
        //TODO:: Sanitize

        $input = $request->all();
        $input = text::purifyQuestionInput($input, $this->purifier);
//        $input = text::purifyQuestionInput($input);
        $input = text::questionFromBBToHTML($input);

        $question = new MarketQuestions;

        $question->createdByUser = Auth::id();
        $question->market = $input['market'];
        $question->message = $input['message'];

        $question->save();

        return Redirect::back();
    }

}
