<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-10-18
 * Time: 18:02
 */

namespace market\helper;

//use market\models\Bid;

use Illuminate\Support\Facades\Log;
use market\models\watchedEvent;

class watched {
    public function newBid($bid)
    {
        Log::debug('helper->watched->newBid');
        //TODO: queue
        //TODO: Single query

//        dd($bid);
        //Add new watchedevent
        // get all watcheds connected to bid->auctionId
        $watcheds = \market\models\watched::where('market', $bid->auctionId)->get();
        foreach($watcheds as $watched)
        {
            Log::debug('In watcheds foreachloop');
            //TODO: If not my own market
//            $user = $watched->user;
//            $market = $watched->market;
//            $events = $watched->events;
            $message = 'Nytt bud: ' . $bid->bid . ', ' . $bid->updated_at;
//            $event = watchedEvent::where('user', $user)->where('market', $market)->orderBy('id', 'desc')->first();
//            $newId = $event == null ? 1 : $event->id + 1;
//            dd($user, $market, $message, $newId, $event);
            $watchedEvent = new watchedEvent([
//                'market' => $market,
//                'user' => $user,
//                'id' => $newId,
                'watched' => $watched->id,
                'read' => 0,
                'message' => $message
            ]);
            $watchedEvent->save(); //&Todo: Move to array and save all item in array???
        }
        // add new watchedevent to all watched, not if bid is placed by watcher
//    dd($watcheds, $bid->auctionId);
        // Multiple updates at once using quering scopes
    }

    public static function marketEnded($market)
    {

    }
}