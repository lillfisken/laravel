<?php namespace market\helper\markets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use market\models\Bid;
use market\models\Market as MarketModel;


class auction extends MarketBase
{
    protected $routeBase = 'auction';
    protected $marketType = 4;
    protected $titleNew = 'Ny auktion';

    public function __construct()
    {
        $this->rules['end_at'] = 'required|date';
        parent::__construct();
    }

    //region Read
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $auction = MarketModel::withTrashed()->with(['bids.user'])->where('id','=',$id)->first();

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

            $auction->end_at_unix = $auction->end_at->timestamp;
//            dd($auction->end_at);
            return view('markets.auction.show', [
                'market'=>$auction,
                'bidCount' => $bidCount,
                'bidHighest' => $bidHighest,
                'yourBid' => $yourBid,
                'marketCommon' => $this->marketCommon,
            ]);
        }
        else
        {
//            dd('Null or not auction');
            abort(404);
        }
    }

    //endregion

    //region Update
    public function editFromStart($id)
    {
        Log::debug('editFromStart');

        $auction = MarketModel::where('id', $id)->with('bids')->first();

        if(!$auction) { abort(404, 'Market not found'); }
        if($auction->createdByUser != Auth::id()) {abort(403, 'Market created by another user');}
        if($auction->bids->count() > 0) {abort(403, 'Auction not allowed to update with bids'); }

        $this->putAuctionDataInSession($id, $auction['createdByUser']);

        return view('markets.' . $this->routeBase . '.create', [
//            'type' => 'edit',
            'title'=> 'Redigera ' . $auction['title'],
            'callbackRoute' => $this->routeBase . '.update.store',
            'marketType' => $this->marketType,
            'model' => $auction,
            'buttons' => [
                'save' => [
                    'title' => 'Publicera',
                    'name' => 'save'
                ],
                'preview' => [
                    'title' => 'Förhandsgranska',
                    'name' => 'previewFromEditForm'
                ]
            ],
        ]);
    }



    //endregion

    public function setHighestBid($auction)
    {
//        dd($auction);
        //TODO: Add highest bid in market db
//        dd($auction->id);
        if($auction->marketType == 4)
        {
            $bids = Bid::where('auctionId', $auction->id)->get();
//        dd($bids, $bids->count());
            $bidHighest = null;
            if($bids->count() > 0)
            {
                $bidHighest = $bids->sortByDesc('bid')->first()->bid;
            }

            $auction['bidHighest'] = $bidHighest;
        }

    }

}