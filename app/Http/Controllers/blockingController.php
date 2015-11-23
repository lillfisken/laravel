<?php namespace market\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use market\core\blocked\blockMarket;
use market\core\blocked\blockUser;
use market\core\blocked\unblockMarket;
use market\core\blocked\unblockUser;
use market\core\session\sessionUrl;
use market\Http\Requests;
use market\Http\Controllers\Controller;

use Illuminate\Http\Request;
use market\models\Market;
use market\models\User;
use PhpParser\Node\Stmt\Use_;

class blockingController extends Controller {

	public function blockMarketGet($marketId, sessionUrl $sessionUrl, Request $request)
	{
		// Confirmation: Do you want to block marketId->title?
        $market = Market::withTrashed()->find($marketId);
        if($market != null)
        {
            $sessionUrl->setPreviousUrl();
            return view('confirm', [
                'title' => 'Blockera ' . $market->title . '?',
                'text' => 'Vill du blockera "' . $market->title . '"?',
                'hidden' => $marketId,
                'callbackRoute' => 'accounts.blockMarketPost'
            ]);
        }
        abort(404);
	}

	public function blockMarketPost(Request $request, blockMarket $blockMarket, sessionUrl $sessionUrl)
	{
		//Get marketId
		//if isset && marketId > 0
		if($request->get('yes'))
		{
//            dd('Yes', $request);
			$marketId = $request->get('hidden');
			$blockMarket->block(Auth::id(), $marketId);
		}

//        dd('no');
		return $sessionUrl->redirectToPreviousUrlOrDefault();
	}

    public function unblockMarketGet($marketId, Request $request, sessionUrl $sessionUrl)
    {
//        dd('unblockMarketGet');
        $market = Market::withTrashed()->find($marketId);
        if($market)
        {
            $sessionUrl->setPreviousUrl();
            return view('confirm', [
                'title' => 'Avblockera ' . $market->title . '?',
                'text' => 'Vill du avblockera "' . $market->title . '"?',
                'hidden' => $marketId,
                'callbackRoute' => 'accounts.unblockMarketPost'
            ]);
        }
        abort(404);
    }

    public function unblockMarketPost(Request $request, unblockMarket $unblockMarket, sessionUrl $sessionUrl)
    {
//        dd('unblockMarketPost');
        if($request->get('yes'))
        {
//            dd('Yes', $request);
            $marketId = $request->get('hidden');
            $unblockMarket->unblock(Auth::id(), $marketId);
        }

        return $sessionUrl->redirectToPreviousUrlOrDefault();
    }

    public function blockSellerGet($sellerUserId, sessionUrl $sessionUrl, Request $request)
    {
        $user = User::find($sellerUserId);
        if($user != null)
        {
            $sessionUrl->setPreviousUrl(null);
            return view('confirm', [
                'title' => 'Blockera ' . $user->username . '?',
                'text' => 'Vill du blockera "' . $user->username . '"?',
                'hidden' => $user->id,
                'callbackRoute' => 'accounts.blockSellerPost'
            ]);
        }
        abort(404);
    }

    public function blockSellerPost(Request $request, blockUser $blockUser, sessionUrl $sessionUrl)
    {
//        dd(URL::previous(), Session::get('_previous'));
//        return $sessionUrl->redirectToPreviousUrlOrDefault();

        if($request->get('yes'))
        {
//            dd('Yes', $request);
            $userId = $request->get('hidden');
            $blockUser->block(Auth::id(), $userId);
        }

        return $sessionUrl->redirectToPreviousUrlOrDefault();
    }

    public function unblockSellerGet($blockedUserId, sessionUrl $sessionUrl, Request $request)
    {
        $user = User::find($blockedUserId);

        if($user)
        {
            $sessionUrl->setPreviousUrl();
            return view('confirm', [
                'title' => 'Häv blockering av ' . $user->username . '?',
                'text' => 'Vill du häva blockeringen av ' . $user->username . '?',
                'hidden' => $user->id,
                'callbackRoute' => 'accounts.unblockSellerPost'
            ]);
        }
        abort(404);
    }

    public function unblockSellerPost(Request $request, unblockUser $unblockUser, sessionUrl $sessionUrl)
    {
        if($request->get('yes'))
        {
            $userId = $request->get('hidden');
            $unblockUser->unblock(Auth::id(), $userId);
        }

        return $sessionUrl->redirectToPreviousUrlOrDefault();
    }
}
