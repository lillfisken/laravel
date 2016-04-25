<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-04-25
 * Time: 22:35
 */

namespace market\Http\Controllers\account;


use Illuminate\Support\Facades\Auth;
use market\core\market\marketPrepare;
use market\core\market\marketType;
use market\core\menu\marketMenu;
use market\Http\Controllers\Controller;
use market\models\blockedUser;
use market\models\Market;
use market\models\User;

class blockedSellersController extends Controller
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
                 * get 'profile/blockedseller/{user}'
                 * route 'accounts.blockedseller''
                 * middleware 'auth'
                 *
                 * @var user
                 * @return
                */
    public function blockedseller()
    {
        $users = User::whereHas('blockedUsers', function($query) {
            $query->where('blockingUserId', '=', Auth::id());
        })
            ->paginate(config('market.paginationNr'));
        $users->setPath(route('accounts.blockedmarket'));

        $blockedUsers = blockedUser::where('blockingUserId', Auth::id())
            ->with('blockedUser')
            ->paginate(config('market.paginationNr'));
        $blockedUsers->setPath(route('accounts.blockedmarket'));

        $markets = Market::onlyMarketsFromBlockedSellers()->paginate(config('market.paginationNr'));
        $markets->setPath(route('accounts.blockedmarket'));
        $this->marketPrepare->addStuff($markets);

        return view('account.markets.blockedSellers', [
            'blockedUsers' => $blockedUsers,
            'markets' => $markets,
            'marketCommon' => $this->marketCommon,
        ]);
    }
}