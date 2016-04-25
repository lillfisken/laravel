<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-04-25
 * Time: 22:20
 */

namespace market\Http\Controllers\account;


use market\core\market\marketPrepare;
use market\core\market\marketType;
use market\core\menu\marketMenu;
use market\Http\Controllers\Controller;
use market\models\Market;

class blockedMarketsController extends Controller
{
    protected $marketCommon;
    protected $marketPrepare;
    protected $marketMenu;

    public function __construct(marketType $marketType, marketPrepare $marketPrepare, marketMenu $marketMenu)
    {
        $this->marketCommon = $marketType;
        $this->marketPrepare = $marketPrepare;
        $this->marketMenu = $marketMenu;
    }

    /* Show user profile
             *
             * get 'profile/blockedmarked/{user}'
             * route 'accounts.blockedmarked'
             * middleware 'auth'
             *
             * @var user
             * @return
            */
    public function blockedmarket()
    {
        $markets = Market::onlyBlockedMarketByUser()
            ->paginate(config('market.paginationNr'));
        $markets->setPath(route('accounts.blockedmarket'));

        $this->marketPrepare->addStuff($markets);

        return view('account.markets.blockedMarkets', [
            'markets' => $markets,
            'marketCommon' => $this->marketCommon,
        ]);
    }
}