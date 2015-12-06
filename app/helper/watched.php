<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-10-18
 * Time: 18:02
 */

namespace market\helper;

//use market\models\Bid;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use market\models\watchedEvent;

class watched {
    public function newBid($bid)
    {
        Log::debug('helper->watched->newBid');

        // get all watcheds connected to bid->auctionId
        $watcheds = \market\models\watched::where('market', $bid->auctionId)->get();
        $toBeSaved = [];
        foreach($watcheds as $watched)
        {
            Log::debug('In watcheds foreachloop');
            if($watched->user != Auth::id())
            {
                $message = 'Nytt bud: ' . $bid->bid . ', ' . $bid->updated_at;

                $toBeSaved[] = [
                    'watched' => $watched->id,
                    'read' => 0,
                    'message' => $message
                ];
            }
        }

        if(count($toBeSaved) > 0)
        {
            DB::table('watched_events')->insert($toBeSaved);
        }
    }

    public static function marketEnded($market)
    {

    }
}