<?php namespace market\helper;

use Illuminate\Support\Facades\Auth;

class marketMenu
{
    public static function addMarketMenu($market)
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
                //TODO: Check if market is blocked, then ad link to unblock instead
                $temp[] = array('text' => 'Dölj annons', 'href' => route('accounts.blockMarket', $market->id));
                //TODO: Check if market is seller, then ad link to unblock instead
                $temp[] = array('text' => 'Dölj säljare', 'href' => route('accounts.blockSeller', $market->createdByUser));
            }

            $market['marketmenu'] = $temp;
        }
    }
}
