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
    ];

    public function __construct(marketType $marketCommon, urlParam $urlParam)
    {
        $this->marketCommon = $marketCommon;
        $this->urlParam = $urlParam;
    }

    public function getAll()
    {
        Log::debug('--- Start search -------------------------------------------------------------------------------');
        if(false)
        {
            $markets = Market::count();
            $marketsAllCount2 = Market::withBlockedMarkets()->count();
            $marketsAllCount3 = Market::withBlockedMarkets()->withTrashed()->count();

            $marketsAllCount35 = DB::table('users')->where('title', '!=', 'hej')->withBlockedMarkets()
                ->withMarketsFromBlockedSellers()
//                ->count()
            ;


            dd(
                $marketsAllCount35,
                Market::select()
            );

            $marketsAllCount4 = Market::withMarketsFromBlockedSellers()->count();
            $firstMarket = Market::first();
//            $onlyBlockedMarkets1 = Market::onlyBlockedMarkets()->with('marketBlockedByUser')->first();
            $onlyBlockedMarkets = Market::onlyBlockedMarkets()->limit(10)->get();
            $onlyBlockedMarketsCount = Market::onlyBlockedMarkets()->count();
            $serachMarket = Market::search('Lorem')->limit(30)->get();
//            $blocked = DB::select('userId')->from('blocked_market')->toSql();

            $testSql1 = Market::whereIn('id', function($query)
                {
                    $query->select(DB::raw(1))
                        ->from('blocked_markets')
                        ->whereRaw('m_blocked_markets.userId = 2');
                })
                ->get();
//
//            $testSql2 = DB::from('blocked_markets')
//                        ->whereRaw('m_blocked_markets.userId = 2')
//                                ->get();


            dd(
                'SearchMarkets->getAll()',
                'Count normal: ' . $markets,
                'Count with blocked markets: ' . $marketsAllCount2,
                'Count with blocked markets and trashed: ' . $marketsAllCount3,
                'Count with blocked markets and trashed and with blocked sellers: ' . $marketsAllCount4,
//                'Count with markets from blocked sellers: ' . $marketsAllCount4,
//                $firstMarket,
//                $serachMarket,
                '$onlyBlockedMarkets1',
//                $onlyBlockedMarkets1,
                '$onlyBlockedMarkets',
                $onlyBlockedMarkets,
                '$onlyBlockedMarketsCount',
                $onlyBlockedMarketsCount
//                $blocked
//                '$testSql1',
//                $testSql1
//                $testSql21
            );
        }

        Log::debug('Core->search->searchMarkets->getAll');
        $markets = Market::paginate(config('market.paginationNr', 20));

//        dd($markets);
        Log::debug('--- End search --------------------------------------------------------------------------------');

        return $markets;
    }

    public function searchSimple($searchTerm)
    {
        return Market::search($searchTerm)->paginate(config('market.paginationNr', 20));
    }

    public function searchAdvanced()
    {
        Log::debug('Core->search->searchMarkets->searchAdvanced');
        Log::debug('-------------------------------------------------------------------------------------------------------------------------------------');

        $urlParam = $this->urlParam;

        // Begining of building db query
        $query = Market::select();

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
                $query->withBlockedMarkets();
//                $query->withoutBlockedMarkets();
            }

            if ($urlParam->isTrue('hs')) {
                $query->withMarketsFromBlockedSellers();
//                $query->blockedSellerByUser();
            }
        }

        //Query the db
        $markets = $query->paginate(config('market.paginationNr'), 20);

        //Blocked Markets
        //Blocked Sellers
        //Active Markets


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