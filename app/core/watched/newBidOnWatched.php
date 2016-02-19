<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-11-18
 * Time: 00:19
 */

namespace market\core\watched;


use market\models\Bid;
use market\models\watchedEvent;

class newBidOnWatched
{
    public function __construct()
    {

    }

    public function newBid($bidId)
    {
//        $watcheds = \market\models\watched::where('market', $bid->auctionId)->get();
//        $bidId = 33;
        //get bids vith bid->market->watcheds
        $bid = Bid::where('id', $bidId)->with('market.watched')->first();

        if($bid)
        {
            foreach($bid->market->watched as $watched)
            {
                $user = $watched->user;
                $market = $watched->market;
                $message = 'Nytt bud, ' . $bid->bid . ', ' . $bid->updated_at;
//                dd($watched, $watched->id);
//                $newId = $watched->events->count() == 0 ? 1 : 123;
//                $event = $watched->events->orderBy('id', 'desc')->first();
//                $newId = $event == null ? 1 : $event->id + 1;
    //            dd($user, $market, $message, $newId, $event);
                $watchedEvent = new watchedEvent([
//                    'market' => $market,
//                    'user' => $user,
                    'watched' => $watched->id,
//                    'id' => $newId,
                    'read' => 0,
                    'message' => $message
                ]);
//                dd($watchedEvent);
//                unset($bid->market);
//                dd($bid);
                $watchedEvent->save();
            }
        }

        dd($bid);

//        foreach($watcheds as $watched)
//        {
//            //TODO: If not my own market
//            $user = $watched->user;
//            $market = $watched->market;
//            $message = 'Nytt bud: ' . $bid->bid . ', ' . $bid->updated_at;
//            $event = watchedEvent::where('user', $user)->where('market', $market)->orderBy('id', 'desc')->first();
//            $newId = $event == null ? 1 : $event->id + 1;
////            dd($user, $market, $message, $newId, $event);
//            $watchedEvent = new watchedEvent([
//                'market' => $market,
//                'user' => $user,
//                'id' => $newId,
//                'read' => 0,
//                'message' => $message
//            ]);
//            $watchedEvent->save();
//        }
    }

//    public function newBid($bid)
//    {
//        Log::debug('helper->watched->newBid');
//
//        // get all watcheds connected to bid->auctionId
//        $watcheds = \market\models\watched::where('market', $bid->auctionId)->get();
//        $toBeSaved = [];
//        foreach($watcheds as $watched)
//        {
//            Log::debug('In watcheds foreachloop');
//            if($watched->user != Auth::id())
//            {
//                $message = 'Nytt bud: ' . $bid->bid . ', ' . $bid->updated_at;
//
//                $toBeSaved[] = [
//                    'watched' => $watched->id,
//                    'read' => 0,
//                    'message' => $message
//                ];
//            }
//        }
//
//        if(count($toBeSaved) > 0)
//        {
//            DB::table('watched_events')->insert($toBeSaved);
//        }
//    }
//
//    public static function marketEnded($market)
//    {
//
//    }
}