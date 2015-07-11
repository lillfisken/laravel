<?php namespace market\Http\Controllers;

use Chromabits\Purifier\Contracts\Purifier;
use DateTime;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use market\helper\debug;
use market\helper\market as marketHelper;
use market\helper\marketCRUD;
use market\helper\text;
use market\Http\Requests;
use market\Http\Controllers\Controller;

use Illuminate\Http\Request;
use market\helper;
use market\helper\bid as helperBid;
use market\Http\Requests\MarketCreateUpdateRequest;
use market\Market;

class MarketAuctionController extends Controller {

    /**
     * @var Purifier
     */
    protected $purifier;
    protected $auctionHelper;
    protected $routeBase;

    /**
     * Construct an instance of MyClass
     *
     * @param Purifier $purifier
     */
    public function __construct(Purifier $purifier) {
        // Inject dependencies
        $this->purifier = $purifier;

        $this->auctionHelper = new helper\auction();

        $this->routeBase = 'auction';
    }

    //region create

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createForm()
	{
		return view('markets.auction.create', [
//            'type' => 'create',
            'title'=>'Ny auktion',
            'callbackRoute' => 'auction.store',
            'marketType' => '4',
            'model' => null,
            'buttons' => [
                'save' => [
                        'title' => 'Publicera',
                        'name' => 'save'
                    ],
                'preview' => [
                        'title' => 'Förhandsgranska',
                        'name' => 'previewFromCreateForm'
                    ]
            ],
        ]);
	}

    public function create(Request $request)
    {
        // Create a new market or show preview for creating a new market

        $input = Input::all();

        //TODO: change to purify auction, add type to request etc...
        $input = text::purifyMarketInput($input, $this->purifier);

        //TODO: Image processing, in each function

//        if($input['type'] == 'create' && isset($input['previewFromCreateForm']))
//        {
//            return $this->auctionHelper->previewFromCreateForm($input);
//        }
//        elseif($input['type'] == 'create' && isset($input['editFromPreview']))
//        {
//            return $this->auctionHelper->editFromCreatePreview();
//        }
//        elseif($input['type'] == 'create' && isset($input['save']))
//        {
//            return $this->auctionHelper->saveFromCreateForm($input);
//        }
//        elseif($input['type'] == 'create' && isset($input['saveFromPreview']))
//        {
//            return $this->auctionHelper->saveFromCreatePreview($input);
//        }

        if(isset($input['previewFromCreateForm']))
        {
            return $this->auctionHelper->previewFromCreateForm($input);
        }
        elseif(isset($input['editFromPreview']))
        {
            return $this->auctionHelper->editFromCreatePreview();
        }
        elseif(isset($input['save']))
        {
            return $this->auctionHelper->saveFromCreateForm($input);
        }
        elseif(isset($input['saveFromPreview']))
        {
            return $this->auctionHelper->saveFromCreatePreview($input);
        }


        abort(404);
    }

    //endregion

    //region read

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $auction = Market::withTrashed()->with(['bids.user'])->where('id','=',$id)->first();

        // If auction exist and is of type auction
        if($auction != null && $auction->marketType == 4)
        {
            $bidCount = $auction->bids->count();
            if($bidCount > 0)
            {
                $bidHighest = $auction->bids->sortByDesc('bid')->first()->bid;
            }
            else
            {
                $bidHighest = 0;
            }

            $yourBid = $auction->bids->where('bidder', Auth::id())->first();
            if($yourBid)
            {
                $yourBid = $auction->bids->where('bidder', Auth::id())->first()->bid;
            }
            else
            {
                $yourBid = 0;
            }

            //TODO: Add market menu
            $this->auctionHelper->addMarketMenu($auction);

//            helper\auction::addMarketMenu($auction, )
//            marketCRUD::addMarketMenu($auction);
//            marketHelper::addMarketMenuAuction($auction);
            //$this->auctionHelper->addMarketMenuPerType($auction);

            return view('markets.auction.show', [
                'market'=>$auction,
                'bidCount' => $bidCount,
                'bidHighest' => $bidHighest,
                'yourBid' => $yourBid,
            ]);
        }
        else
        {
            dd('Null or not auction');
            abort(404);
        }
    }

    //endregion

    //region update

    public function updateForm($id)
    {
        return $this->auctionHelper->editFromStart($id);
    }

    public function update(Request $request)
    {
        $input = Input::all();

        //TODO: change to purify auction, add type to request etc...
        $input = text::purifyMarketInput($input, $this->purifier);

        if(isset($input['previewFromEditForm']))
        {
            return $this->auctionHelper->previewFromEditForm($input);
        }
        elseif(isset($input['save']))
        {
            return $this->auctionHelper->saveFromEditForm($input);
        }
        elseif(isset($input['saveFromPreview']))
        {
            return $this->auctionHelper->saveFromEditPreview();
        }
        elseif(isset($input['editFromPreview']))
        {
            return $this->auctionHelper->editFromEditPreview();
        }

        abort(404);
    }

    //endregion

    //region delete

    /**
     * Remove the specified resource from storage.
     * DELETE /markets/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroyGet($market, Request $request)
    {
        Session::put('uri', Session::get('_previous'));

//        $reasons = marketEndReason::getAllTypes();
        $reasons = $this->auctionHelper->getAllEndReasons();
//        $reasons = ['Varan såld' => 'Varan såld', 'Övrigt' => 'Övrigt'];

        return view('markets.base.delete', ['market' => $market, 'reasons' => $reasons, 'callBackRoute' => $this->routeBase . '.destroy.post']);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /markets/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroyPost(Request $request)
    {
        //TODO:
//        dd('deleteing market in marketAuctionController');
        $id = Input::get('market');
        $market = Market::where('id', '=', $id)->firstorfail();
        //dd(Input::all());

        $market['endReason'] = Input::get('reason');
        $market['deleted_at'] = new DateTime();
        $market->save();

        $uri = Session::get('uri');
//        dd($uri);

        if(isset($uri))
        {
            //dd($uri);
            if(isset($uri['url']))
            {
                //dd($uri['url']);
                return redirect($uri['url']);
            }
            return redirect()->route('markets.index');
            //return URL::to($uri);

            //return redirect('markets/public');
        }
        else
        {
            dd('redirect route');
            return redirect()->route('markets.index');
        }

    }
    //endregion

    //region Bids

    public function placeBid(Request $request)
    {
        //TODO: BidRequest
        $market = $request->id;
        $bid = $request->bid;
        $bidder = Auth::id();

        $placedBid = helperBid::placeBid($market, $bidder, $bid);


        return redirect()->route('auction.show', $market);

//        dd('id: '.$market,
//            'bid: '.$bid,
//            'bidder: ' . $bidder,
//            'placed bid: ' . $placedBid,
//            $request);
    }

    public function showAllBids($id)
    {
        $auction = Market::
            with(['bids'=>function($query){
                $query->with('user')->orderBy('updated_at', 'desc');
            }])
            ->where('id','=',$id)
            ->first();

        return view('markets.auction.showAllBids', ['auction'=>$auction]);
    }

    //endregion
}
