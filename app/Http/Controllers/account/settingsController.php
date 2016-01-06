<?php namespace market\Http\Controllers\account;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use market\helper\text;
use market\Http\Requests;
use market\Http\Controllers\Controller;

use Illuminate\Http\Request;

class settingsController extends Controller {

	/* Show user settings
                 *
                 * get 'profile/settings/{user}'
                 * route 'accounts.settings'
                 * middleware 'auth'
                 *
                 * @var user
                 * @return
                */
	public function settings()
	{
		$user = Auth::user();

		$user['presentation'] = text::htmlToBbCode($user['presentation']);

		return view('account.settings.settings', ['user' => $user]);

	}

	/**
	 * @param UserSettingsRequest $userSettingsRequest
	 * @return mixed
	 */
	public function saveSettings(Requests\settings\userprofileRequest $request)
	{
		$user = Auth::user();

		$input = $request->all();
		$input['presentation'] = text::bbCodeToHtml($input['presentation']);

		//TODO: Purify input
		$checkboxes = [
			'mailNewPm',
			'mailNewBidMyAuction',
			'mailMyAuctionEnded',
			'mailAuctionWatched',
			'mailMarketEnded'
		];

		foreach($checkboxes as $checkbox)
		{
			if(!$request->has($checkbox))
			{
				$input[$checkbox] = 0;
			}
		}

		$user->fill($input);
//        dd($userSettingsRequest, $user);
		$user->save();

		$user['presentation'] = text::htmlToBbCode($user['presentation']);

		return Redirect::route('accounts.settings.settings')
			->with('user', $user)
			->with('notification', 'Inställningar sparade');
//        return view('account.settings.settings', ['user' => $user, 'notification' => 'Inställningar sparade']);//->with('message', 'Inställningar sparade');
	}
}
