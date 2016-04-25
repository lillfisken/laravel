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
use Illuminate\Support\Facades\DB;
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
        'oam', //only active markets
    ];

    public function __construct(marketType $marketCommon, urlParam $urlParam)
    {
        $this->marketCommon = $marketCommon;
        $this->urlParam = $urlParam;
    }

    public function getAll()
    {
//        dd('hej');
        Log::debug('--- Start search -------------------------------------------------------------------------------');
        if(false)
        {
//            $markets = Market::count();
//            $marketsAllCount2 = Market::withBlockedMarkets()->count();
//            $marketsAllCount3 = Market::withMarketsFromBlockedSellers()->withTrashed()->count();

//            $marketsAllCount35 = DB::table('users')->where('title', '!=', 'hej')->withBlockedMarkets()
//                ->withMarketsFromBlockedSellers()
//                ->count()
//            ;

            dd(
                'Blocked sellers',
                Market::count(),
                Market::withoutMarketsFromBlockedSellers()->count(),
                Market::onlyMarketsFromBlockedSellers()->count(),
                Market::select()->withTrashed()->count(),
                Market::withoutMarketsFromBlockedSellers()->withTrashed()->count(),
                Market::onlyMarketsFromBlockedSellers()->withTrashed()->count(),
                '--------------------------------------------------------------------------',
                'Blocked Markets',
                Market::count(),
                Market::withoutBlockedMarketByUser()->count(),
                Market::onlyBlockedMarketByUser()->count(),
                Market::withTrashed()->count(),
                Market::withoutBlockedMarketByUser()->withTrashed()->count(),
                Market::onlyBlockedMarketByUser()->withTrashed()->count()
            );
        }

        Log::debug('Core->search->searchMarkets->getAll');
        $query = Market::select();

        if(Auth::check())
        {
            $query->withoutMarketsFromBlockedSellers();
            $query->withoutBlockedMarketByUser();
        }

        $markets = $query->paginate(config('market.paginationNr', 20));

        Log::debug('--- End search --------------------------------------------------------------------------------');

        return $markets;
    }

    public function searchSimple($searchTerm)
    {
        return Market::search($searchTerm)->paginate(config('market.paginationNr'));
    }

    public function searchAdvanced()
    {
        Log::debug('Core->search->searchMarkets->searchAdvanced');
        Log::debug('-------------------------------------------------------------------------------------------------------------------------------------');

        $urlParam = $this->urlParam;

        // Begining of building db query
        $query = Market::select();
//        $query->limit(50);
//
//        $query->whereHas('user', function($query) use($urlParam)
//        {
//            $query->search('lilla');
//        });
//
//        dd($query->get());

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
            if (!$urlParam->isTrue('hm')) {
                $query->withoutBlockedMarketByUser();
//                $query->withoutBlockedMarkets();
            }

            if (!$urlParam->isTrue('hs')) {
                $query->withoutMarketsFromBlockedSellers();
//                $query->blockedSellerByUser();
            }
        }

        if($urlParam->exist('oam'))
        {
            $query->onlyTrashed();
        }

        //Query the db
        $markets = $query->paginate(config('market.paginationNr'),20);

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