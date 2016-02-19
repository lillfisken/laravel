<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-15
 * Time: 22:02
 */

namespace market\core\market\update;


class auction extends base
{
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

    public function setBidCount($market)
    {
        $market->bidCount = 666;
        //Todo:
    }

    public function setYourBid($market)
    {
        $market->yourBid = 666;
        //todo:
    }
}