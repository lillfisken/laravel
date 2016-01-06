<?php namespace market\Http\Controllers\Markets\auction;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use market\core\bid\placeBid;
use market\Http\Requests;
use market\Http\Controllers\Controller;

use Illuminate\Http\Request;
use market\models\Market;

class timeController extends Controller {
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
