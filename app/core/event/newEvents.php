<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-21
 * Time: 13:45
 */

namespace market\core\event;

use market\helper\mailer;
use market\models\Bid;
use market\models\eventMarket;
use market\models\eventUser;
use market\models\watchedMarketsByUser;


class newEvents
{
    public function __construct(mailer $mailer)
    {
        //TODO:
        $this->mailer = $mailer;
    }

    public function newBidAuction($bidId)
    {
        //TODO: delete
        $bid = Bid::with('market')->find($bidId);
        //Send mail to owner
        $this->mailer->sendMailNewBidOnMyAuction($bid);
        $this->mailer->sendMailNewBidWatchedAuction($bidId);
        //Add to watched-user
        $newEvent = new eventMarket();
        $newEvent->market = $bid->auctionId;
        $newEvent->body = 'Nytt bud på "' . $bid->market->title . '": ' . $bid->bid . ' av ' . $bid->user->username;
        $newEvent->save();
//        dd($newEvent);
//        //TODO: create event_market;
//        $watchers = watchedMarketsByUser::where('market', $bid->auctionId)->get();
//        foreach($watchers as $watcher)
//        {
//            $e = new eventUser();
//            $e->marketId = $watcher->market;
//            $e->userId = $watcher->user;
//            $e->eventId = $newEvent->save();
//            $e->save();
//        }
//        dd($watchers, $bid);
    }
//
//    public function deletedMarket($marketId)
//    {
//        //TODO:
//    }
//
//    public function endedAuction($auctionId)
//    {
//        //TODO:
//    }
//
//    public function marketUpdated($marketId)
//    {
//        //TODO:
//    }
}