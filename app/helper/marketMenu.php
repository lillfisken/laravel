<?php namespace market\helper;

use Illuminate\Support\Facades\Auth;
use market\models\watched;

class marketMenu
{
    public static function addMarketMenu($market, $watched = [], $options = [])
    {
        if(Auth::check()) {
            $userId = Auth::id();
            $temp = array();
            $routeBase = routeBase::getRouteBase($market->marketType);

            //Adds link to edit market if it's created by logged in user
            if ($userId == $market->createdByUser &&
                $market->deleted_at == null &&
                !($market->bids->count() > 0))
            {
                $temp[] = array('text' => 'Redigera ', 'href' => route($routeBase . '.update', $market->id ));
                $temp[] = array('text' => 'Avslutad', 'href' => route( $routeBase . '.destroy.get', $market->id ));
            }

            if  ($userId != $market->createdByUser) {
                //Watched
                if(in_array($market['id'], $watched))
                {
                    $market['watched'] = 1;
                    $temp[] = array('text' => 'Inaktivera bevakning', 'href' => route('accounts.unwatchMarket', $market->id));
                }
                else
                {
                    $temp[] = array('text' => 'Bevaka annons', 'href' => route('accounts.watchMarket', $market->id));
                }

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
                //TODO: Check if market is seller, then ad link to unblock instead
                $temp[] = array('text' => 'Dölj säljare', 'href' => route('accounts.blockSeller', $market->createdByUser));
            }

            $market['marketmenu'] = $temp;
        }
    }

    public static function addMarketMenuToMarkets($markets)
    {
        $watched = watched::getAllMarketIdsWatchedByUserId(Auth::id());
        foreach($markets as $market)
        {
            self::addMarketMenu($market, $watched);
        }
//        dd($markets, $watched);
    }
}
