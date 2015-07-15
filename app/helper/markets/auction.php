<?php namespace market\helper\markets;

use Illuminate\Support\Facades\Auth;
use market\Market;

class auction extends MarketBase
{
    protected $routeBase = 'auction';
    protected $marketType = 4;
    protected $titleNew = 'Ny auktion';

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
//        dd('market\auction');
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
            $this->addMarketMenu($auction);

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

}