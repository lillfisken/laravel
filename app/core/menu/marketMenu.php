<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-05
 * Time: 19:52
 */

namespace market\core\menu;


use Illuminate\Support\Facades\Auth;
use market\helper\routeBase;
use market\models\watched;

class marketMenu
{
    public function addMarketMenu($market, $watched = [], $options = [])
    {
//        dd(config('market.routeBases'), config('market.routeBases')[2], config('market.routeBases')[7]);
        if(Auth::check()) {
            $userId = Auth::id();
            $temp = array();
            $routeBase = config('market.routeBases')[$market->marketType];

            if  ($userId != $market->createdByUser)
            {
                $temp = $this->addWatchedMarketMenu($temp, $market, $watched);
                $temp = $this->addBlockedMarketMenu($temp, $market, $routeBase);
                $temp = $this->addBlockedSellerMenu($temp, $market, $routeBase);
            }

            $temp = $this->addBlockedEditMenu($temp, $market, $routeBase, $userId);
            $this->addHasEvents($market);
            $this->addIsWatched($market);

//            dd($temp);
            $market['marketmenu'] = $temp;
        }
    }

    public function addMarketMenuToMarkets($markets)
    {
        $watched = watched::getAllMarketIdsWatchedByUserId(Auth::id());
        foreach($markets as $market)
        {
            $this->addMarketMenu($market, $watched);
        }
    }

    private function addHasEvents($market)
    {
        if( $market && $market->watched && $market->watched->unreadEvents->count() < 0 )
        {
            $market->hasEvents = true;
        }
    }

    private function addIsWatched($market)
    {
        if( $market && isset($market->watched) )
        {
            $market->isWatched = count($market->watched) > 0;
        }
    }

    private function addBlockedEditMenu($temp, $market, $routeBase, $userId)
    {
        //Adds link to edit market if it's created by logged in user
        if ($userId == $market->createdByUser &&
            $market->deleted_at == null &&
            !($market->bids->count() > 0))
        {
            $temp[] = array('text' => 'Redigera ', 'href' => route($routeBase . '.updateForm', $market->id ));
            $temp[] = array('text' => 'Avslutad', 'href' => route( $routeBase . '.destroy.get', $market->id ));
        }

        return $temp;
    }

    private function addBlockedMarketMenu($temp, $market, $routeBase)
    {
        //Blocked
        //TODO: Check if market is blocked, then ad link to unblock instead
        if(isset($options['blocked']))
        {
            $temp[] = array('text' => 'Visa annons', 'href' => route('accounts.unblockMarket', $market->id));
        }
        else
        {
            $temp[] = array('text' => 'Dölj annons', 'href' => route('accounts.blockMarket', $market->id));
        }

        return $temp;
    }

    private function addBlockedSellerMenu($temp, $market, $routeBase)
    {
        //TODO: Check if market is seller, then ad link to unblock instead
        $temp[] = array('text' => 'Dölj säljare', 'href' => route('accounts.blockSeller', $market->createdByUser));

        return $temp;
    }

    private function addWatchedMarketMenu($temp, $market, $watched)
    {
        if($market->end_at == null)
        {
            //Watched
            if(in_array($market['id'], $watched))
            {
//                    $market['isWatched'] = 1;
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