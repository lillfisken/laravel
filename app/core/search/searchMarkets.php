<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-01-17
 * Time: 23:36
 */

namespace market\core\search;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use market\core\market\marketType;
use market\core\urlParam;
use market\models\Market;

class searchMarkets
{
    private $searchValues = [
        'e', //ended
        's', //seller
        'hm', //hidden markets
        'hs', //hidden sellers
        'st', //searchterm
    ];

    public function __construct(marketType $marketCommon, urlParam $urlParam)
    {
        $this->marketCommon = $marketCommon;
        $this->urlParam = $urlParam;
    }

    public function getAll()
    {
//        Log::debug('Core->search->searchMarkets->getAll');
        $markets = Market::select()
            ->with('user')
//            ->with('watched.unreadEvents')
            ->with('unreadEventsForUser')
            ->with('watchedByUser')
            ->with('bids')
            ->withoutBlockedMarkets()
            ->blockedSellerByUser()
            ->paginate(config('market.paginationNr', 20));

//        dd($markets);
        return $markets;
    }

    public function searchSimple($searchTerm)
    {
//        Log::debug('Core->search->searchMarkets->searchSimple');

//        dd($searchTerm);

        $markets = Market::search($searchTerm)
            ->with('User')
//            ->with('watched.unreadEvents')
            ->withoutBlockedMarkets()
            ->blockedSellerByUser()
            ->paginate(config('market.paginationNr', 20));

        return $markets;
    }

    public function searchAdvanced()
    {
//        Log::debug('Core->search->searchMarkets->searchAdvanced');

        $urlParam = $this->urlParam;

        // Begining of building db query
        $query = Market::select()
            ->with('User');
//            ->with('watched.unreadEvents');

        // Remove deleted markets from query if box checked
        if ($urlParam->isTrue('e')) {
            $query->withTrashed();
        }

//		// Add type af markets to query depending on which boxes are ticked
        $query->where(function ($query) use ($urlParam) {
            foreach ($this->marketCommon->getAllMarketTypes() as $key => $val) {
                if ($urlParam->isTrue('t' . $key)) {
                    $query->orWhere('marketType', '=', $key);
                }
            }
        });

        if($urlParam->exist('st'))
        {
            //Search free text
            $query->search($urlParam->get('st'));
        }

        if($urlParam->exist('se'))
        {
            //Search seller
            $query->whereHas('user', function($query) use($urlParam)
            {
                $query->search($urlParam->get('se'));
            });

        }

        if (Auth::check()) {
            if ($urlParam->isTrue('hm')) {
                $query->withoutBlockedMarkets();
            }

            if ($urlParam->isTrue('hs')) {
                $query->blockedSellerByUser();
            }
        }

        //Query the db
        $markets = $query->paginate(config('market.paginationNr'), 20);

        return $markets;
    }

    public function getSearchOptions(Request $request)
    {
//        Log::debug('Core->search->searchMarkets->getSearchOptions');

        $options = [];

        //Add market types
        foreach ($this->marketCommon->getAllMarketTypes() as $key => $val) {
            $temp = 't' . $key;
            $options[$temp] = $request->get($temp);
        }

        foreach ($this->searchValues as $value) {
            $options[$value] = $request->get($value);
        }

        return $options;
    }

}