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
        $markets = Market::select()
            ->with('User')
//            ->with('watched.unreadEvents')
            ->with('unreadEventsForUser')
            ->withoutBlockedMarkets()
            ->blockedSellerByUser()
            ->paginate(config('market.paginationNr', 20));

        return $markets;
    }

    public function searchSimple($searchTerm)
    {
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