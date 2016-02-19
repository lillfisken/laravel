<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-15
 * Time: 21:11
 */

namespace market\core\market\delete;


use market\models\Market;

abstract class base
{
    public function deleteGet($id)
    {
        Session::put('uri', Session::get('_previous'));

//        $reasons = marketEndReason::getAllTypes();
        $reasons = $this->getAllEndReasons();
//        $reasons = ['Varan såld' => 'Varan såld', 'Övrigt' => 'Övrigt'];

        $market = MarketModel::find($id);

        return view('markets.base.delete', [
            'market' => $market,
            'reasons' => $reasons,
            'callBackRoute' => $this->routeBase . '.destroy.post']);
    }

    public function deletePost()
    {
//TODO:
//        dd('deleteing market in marketAuctionController');
        $id = Input::get('market');
        $market = Market::where('id', '=', $id)->firstorfail();
        //dd(Input::all());

        $market['endReason'] = Input::get('reason');
        $market['deleted_at'] = new DateTime();
        $market->save();

        $uri = Session::get('uri');
//        dd($uri);

        if (isset($uri)) {
            //dd($uri);
            if (isset($uri['url'])) {
                //dd($uri['url']);
                return redirect($uri['url']);
            }
            return redirect()->route('markets.index');
            //return URL::to($uri);

            //return redirect('markets/public');
        } else {
            return redirect()->route('markets.index');
        }

    }

    //region Market end reason
    private static $endreasons = [
        '0' => 'Såld/Skänkt',
        '1' => 'Slängd',
        '2' => 'Återtagen',
        '3' => 'Övrigt'
    ];

    public static function getAllEndReasons()
    {
        return self::$endreasons;
    }

    public static function getEndReasonName($number)
    {
        if(self::$endreasons[$number] != null)
        {
            return self::$endreasons[$number];
        }

        abort('404', 'Number is not a market end type');
    }
}