<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-07
 * Time: 23:35
 */

namespace market\core;



use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as Facade;

trait session
{
    public function getMarketFromSession($withUser = true)
    {
        $market = Facade::get('auction');

        if(!$withUser)
        {
            unset($market->user);
        }

        $marketData = $this->getMarketDataFromSession();

        if($marketData)
        {
            $market->createdByUser = $marketData['createdByUser'];

            if($marketData['id'] != 0)
            {
                $market->id = $marketData['id'];
                $market->exists = true;
            }
        }

        return $market;
    }

    public function putAuctionInSession($market, $id=null, $createdByUser=null)
    {
        Facade::put('auction', $market);

//        dd('putAUctionInSession', $market, $id, $createdByUser);

        if($id!=null && $createdByUser!=null)
        {
            $this->putAuctionDataInSession($id,$createdByUser);
        }
        else
        {
            $this->putAuctionDataInSession(0, Auth::id());
        }
    }

    /**
     *     Return array vith auction data
     */
    public function getMarketDataFromSession()
    {
        $marketData = json_decode(Facade::get('auctionData'), true);
        if(!$marketData) { abort(403); } //Abort if auction is not in session

        return $marketData;
    }

    public function putAuctionDataInSession($id, $createdByUser)
    {
//        dd('putAuctionDataInSession', $id, $createdByUser);
        Facade::put('auctionData', json_encode(['id'=> $id, 'createdByUser' => $createdByUser]));
    }

    public function clearSession()
    {
        Facade::forget('auction');
        Facade::forget('auctionData');
    }
}