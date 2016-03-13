<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-03-08
 * Time: 00:43
 */

namespace market\Http\Controllers\Markets;


use market\Http\Controllers\Controller;
use market\models\eventMarket;

class eventController extends Controller
{
    public function allEvents($marketId)
    {
        $events = eventMarket::where('market', $marketId)->get();
//        $events2 = eventMarket::where($marketId, 'market')->get();
//        dd('allEvents', $marketId, $events);
        return view('markets.events')
            ->with('events', $events);
    }
}