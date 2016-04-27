<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-10-05
 * Time: 22:48
 */

namespace market\ViewComposers;


use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use market\core\time;
use market\core\urlParam;
use market\models\blockedMarket;
use market\models\blockedUser;
use market\models\Market;

class all
{
    protected $time;

    public function __construct(urlParam $urlParam, time $time)
    {
        $this->time = $time;
        $this->urlParam = $urlParam;
//        dd('all view composer', $this->time);
    }

    public function compose(View $view)
    {
        $view->with('time', $this->time);
        $view->with('urlParam', $this->urlParam);
        $view->with('blocked', $this->blocked());
    }

    private function blocked()
    {
        $blockedTotal =  blockedMarket::where('userId', Auth::id())->count();
        $blockedBySellers = Market::onlyMarketsFromBlockedSellers()->count();

        $temp = [];
        $temp['total'] = $blockedTotal + $blockedBySellers;
        $temp['sellers'] = blockedUser::where('blockingUserId', Auth::id())->count();
        $temp['marketsBySellers'] = $blockedBySellers;

        return $temp;
    }
}