<?php namespace market\Http\Controllers\Markets;

use Chromabits\Purifier\Purifier;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use market\Bid;
use market\Http\Requests;
use market\Http\Controllers\Controller;
use market\helper;

use Illuminate\Http\Request;
use market\Http\Requests\BidRequest;
use market\Market;
use market\Http\Requests as MarketRequests;

class AuctionController extends BaseController {

    public function __construct(Purifier $purifier)
    {
        parent::__construct($purifier);

        $this->marketHelper = new helper\markets\auction();

    }

    //region Bids

    //TODO: Move to bid controller
    public function placeBid(BidRequest $request)
    {
        //TODO: BidRequest
        $market = $request->id;
        $bid = $request->bid;
        $bidder = Auth::id();

        helper\bid::placeBid($market, $bidder, $bid);

        return redirect()->route('auction.show', $market);
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

    public function getAuctionEndTimeJson($auctionId)
    {
//        $higestBid = Bid::select('bid')->where('auctionId', $auctionId)->orderBy('bid', 'decs')->first();
        $market = Market::where('id', $auctionId)->first();
        if($market)
        {
            return new JsonResponse(['end_at' => $market->end_at->timestamp ]) ;
        }
        else
        {
            return new JsonResponse(['end_at' => null]) ;
        }
    }
}
