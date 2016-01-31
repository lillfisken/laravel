<?php namespace market\Http\Controllers\account;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use market\core\auth\profileSettings;
use market\helper\text;
use market\Http\Requests;
use market\Http\Controllers\Controller;

use Illuminate\Http\Request;
use market\Http\Requests\settings\userprofileRequest;

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
	public function saveSettings(userprofileRequest $request, profileSettings $profileSettings)
	{
//        dd('test', $request);
		$user = Auth::user();

		$input = $request->all();
		$input['presentation'] = text::bbCodeToHtml($input['presentation']);

		//TODO: Purify input

		$input = $profileSettings->setCheckboxesOptions($input);

		$user->fill($input);
//        dd($userSettingsRequest, $user);
		$user->save();

		$user['presentation'] = text::htmlToBbCode($user['presentation']);

//		return Redirect::route('markets.index')
		return Redirect::route('accounts.settings.settings')
			->with('user', $user)
			->with('message', 'Inställningar sparade');
	}
}
