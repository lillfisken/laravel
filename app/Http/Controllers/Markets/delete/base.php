<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-03-19
 * Time: 18:00
 */

namespace market\Http\Controllers\Markets\delete;


use Illuminate\Http\Request;
use market\core\session\sessionUrl;
use market\Http\Controllers\Controller;
use market\models\Market;

trait base
{
    protected $routeBase;
    protected $endReasons;

    public function baseDestroyGet($marketId, sessionUrl $url)
    {
        //TODO: Check only my market
        $url->setPreviousUrl();

        $market = Market::find($marketId);
        if ($market == null) {
            //TODO: Redirect back with error message
            dd(null);
        }

        $reasons = array_intersect_key(config('market.endReasons'), $this->endReasons);

        return view('markets.delete.confirm', [
            'title' => 'Radera ' . $market->title . '?',
            'callbackRoute' => $this->routeBase . '.destroy.post',
            'text' => 'Är du säker på att du vill avsluta ' . $market->title . '?',
            'reasons' => $reasons,
            'hidden' => $market->id
        ]);
    }

    public function baseDestroyPost(Request $request, sessionUrl $url)
    {
        if ($request->get('yes')) {
            $market = Market::find($request->get('hidden'));
            if ($market) {
                $market->endReason = $request->get('reason');
                $market->save();
                $market->delete();
            }

            return $url->redirectToPreviousUrlOrDefault()->with('message', $market->title . ' avslutad'); //TODO: Add message
        }

        return $url->redirectToPreviousUrlOrDefault(); //TODO: Add message
    }
}