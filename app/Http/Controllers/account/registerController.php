<?php namespace market\Http\Controllers\account;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use market\core\auth\profileSettings;
use market\Http\Controllers\Controller;

use market\Http\Requests\register\registerRequest;
use market\models\User;

class registerController extends Controller {

	public function register()
	{
        //TODO: Save url session
		return view('account.auth.register');
	}

	public function registerPost(registerRequest $request, profileSettings $profileSettings)
	{
		Log::debug('registerController->registerPost');
		//TODO:Purify

		$input = $request->all();
		$input = $profileSettings->setCheckboxesOptions($input);
		$newUser = new User($input);
		$newUser->password = Hash::make($request->input('password'));
		$newUser->username = $request->input('username');
		$newUser->save();
        Log::debug('new user saved');
//        dd($newUser);

		//Login user
		Auth::login($newUser);

		//TODO:Send email to new user, test if this is working...
//		Mail::send('emails.auth.register', ['user' => $newUser], function($message, $newUser)
//		{
//			$message->to($newUser->email, $newUser->username)->subject('Välkommen!');
//		});

        //TODO: redirect to url session
		return redirect()->route('markets.index')->with('message', $newUser->username . ' registrerad');
	}

}
