<?php namespace market\Http\Controllers;

use Chromabits\Purifier\Contracts\Purifier;
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

    /**
     * Construct an instance of MyClass
     *
     * @param Purifier $purifier
     */
    public function __construct(Purifier $purifier) {
        // Inject dependencies
        $this->purifier = $purifier;

        $this->auctionHelper = new helper\auction();
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

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $auction = Market::withTrashed()->with(['bids.user'])->where('id','=',$id)->first();

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

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

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
