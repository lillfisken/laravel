<?php namespace market\Http\Controllers\Markets\auction;

use Illuminate\Support\Facades\Auth;
use market\core\bid\placeBid;
use market\Http\Requests;
use market\Http\Controllers\Controller;

use Illuminate\Http\Request;
use market\models\Market;

class bidController extends Controller {

	public function placeBid(Request $request, placeBid $placeBid)
	{
		//TODO: BidRequest
		$marketID = $request->id;

		$placeBid->place($request->id, Auth::id(), $request->bid);
		//TODO: If success...
		return redirect()->route('auction.show', $marketID);
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
}
