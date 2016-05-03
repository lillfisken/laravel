<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-05
 * Time: 19:52
 */

namespace market\core\menu;

use Illuminate\Support\Facades\Auth;
use market\models\Market;

class marketMenu
{
    public function addMarketMenu($market)
    {
//        Log::debug('Core->menu->marketMenu->addMarketMenu');

        if(Auth::check()) {
            $userId = Auth::id();
            $temp = array();

            if  ($userId != $market->createdByUser)
            {
                $temp = $this->addWatchedMarketMenu($temp, $market);
                $temp = $this->addBlockedMarketMenu($temp, $market);
                $temp = $this->addBlockedSellerMenu($temp, $market);
            }

            $temp = $this->addBlockedEditMenu($temp, $market, $userId);
            $this->addHasEvents($market);
            $this->addIsWatched($market);

//            dd($temp);
            $market['marketmenu'] = $temp;
        }
    }

    public function addMarketMenuToMarkets($markets)
    {
//        Log::debug('Core->menu->marketMenu->addMarketMenuToMarkets');

        foreach($markets as $market)
        {
            $this->addMarketMenu($market);
        }
    }

    private function addHasEvents($market)
    {
//        Log::debug('Core->menu->marketMenu->addHasEvents');

        if( $market && $market->unreadEventsForUser->count() > 0)
        {
            $market->hasEvents = true;
        }
    }

    private function addIsWatched($market)
    {
//        Log::debug('Core->menu->marketMenu->addIsWatched');

        if( $market && $market->watchedByUser != null )
        {
            $market->isWatched = true;
        }
    }

    private function addBlockedEditMenu($temp, Market $market, $userId)
    {
//        Log::debug('Core->menu->marketMenu->addBlockedEditMenu');

        //Adds link to edit market if it's created by logged in user
        if ($userId == $market->createdByUser &&
            $market->deleted_at == null &&
            !($market->bids->count() > 0))
        {
            $temp[] = array('text' => 'Redigera ', 'href' => route( $market->getRouteBase() . '.updateForm', $market->id ));
            $temp[] = array('text' => 'Avslutad', 'href' => route( $market->getRouteBase() . '.destroy.get', $market->id ));
        }

        return $temp;
    }

    private function addBlockedMarketMenu($temp, Market $market)
    {
//        Log::debug('Core->menu->marketMenu->addBlockedMarketMenu');

        if($market->marketBlockedByUser()->count() > 0)
        {
            $temp[] = array('text' => 'Visa annons', 'href' => route('accounts.unblockMarket', $market->id));
        }
        else
        {
            $temp[] = array('text' => 'Dölj annons', 'href' => route('accounts.blockMarket', $market->id));
        }

        return $temp;
    }

    private function addBlockedSellerMenu($temp, Market $market)
    {
//        Log::debug('Core->menu->marketMenu->addBlockedSellerMenu');

        if($market->marketUserBlockedByUser()->count() > 0)
        {
            $temp[] = array('text' => 'Visa säljarens annonser', 'href' => route('accounts.unblockSeller', $market->createdByUser));
        }
        else
        {
            $temp[] = array('text' => 'Dölj säljare', 'href' => route('accounts.blockSeller', $market->createdByUser));
        }

        return $temp;
    }

    private function addWatchedMarketMenu($temp, $market)
    {
//        Log::debug('Core->menu->marketMenu->addWatchedMarketMenu');

        if($market->end_at == null)
        {
            //Watched
            if($market->watchedByUser != null)
            {
                $temp[] = array('text' => 'Inaktivera bevakning', 'href' => route('accounts.unwatchMarket', $market->id));
            }
            else
            {
                $temp[] = array('text' => 'Bevaka annons', 'href' => route('accounts.watchMarket', $market->id));
            }
        }

        return $temp;
    }

}