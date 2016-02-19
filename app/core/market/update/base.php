<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-15
 * Time: 21:09
 */

namespace market\core\market\update;


use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use market\core\image;
use market\core\interfaces\iMarketUpdate;
use market\core\session;
use market\core\text;
use market\models\Market;

abstract class base implements iMarketUpdate
{
    use session;

    protected $image;
    protected $text;

    public function __construct(text $text, image $image)
    {
        $this->text = $text;
        $this->image = $image;
    }

    public function editFromStart($id)
    {
        $auction = Market::find($id);
        if(!$auction) { abort(404); }
//        dd($auction);
        if($auction->createdByUser != Auth::id()) {abort(403);}

        $this->putAuctionDataInSession($id, $auction['createdByUser']);

        return $auction;
    }

    public function saveFromEditForm($input)
    {
        $input = $this->text->marketFromBbToHtml($input);
        $auctionData = $this->getMarketDataFromSession();

        $input = $this->image->saveImages($input, true);

        $market = new Market($input);
        $market->createdByUser = $auctionData['createdByUser'];
        $market->id = $auctionData['id'];

        //TODO: Confirm update true/false
        $this->update($market);

        $this->clearSession();

        return $market;
    }

    public function previewFromEditForm($input)
    {
        $input = $this->image->saveImages($input); //TODO: Check, save temp?
        $market = new Market($this->text->marketFromBbToHtml($input));
        $market->user = Auth::user();

        $market->created_at = new Carbon($market->created_at);
        $market->updated_at = new Carbon($market->updated_at);

        //?? Why do like this?, To get auction id and cretaed by user
        $auctionData = $this->getMarketDataFromSession();
        $marketFromDb = Market::find($auctionData['id']);
        if($marketFromDb)
        {
            $market->marketType = $marketFromDb->marketType;

        }
//        dd($market, Market::find($auctionData['id']), $market->id, $auctionData);

        $this->putAuctionInSession($market, $auctionData['id'], $auctionData['createdByUser']);

        return $market;
    }

    public function saveFromEditPreview()
    {
        $market = $this->getMarketFromSession(false);

        //TODO: Move images from temp to persistent

        $this->update($market);
        $this->clearSession();

        return $market;
    }

    public function editFromEditPreview()
    {
        $market = $this->getMarketFromSession();
        $this->putAuctionDataInSession($market->id, $market->createdByUser);

        return $market;
    }

    protected function update($market)
    {
//        dd('MarketBase 364', $market);
        if(isset($market->createdByUser) &&
            isset($market->id) &&
            $market->id > 0)
        {
            $market->exists = true;
            return $market->save();
        }

        abort(400);
    }
}