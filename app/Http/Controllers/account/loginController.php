<?php namespace market\Http\Controllers\account;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use market\core\session\sessionUrl;
use market\Http\Requests;
use market\Http\Controllers\Controller;

use Illuminate\Http\Request;

class loginController extends Controller {

	public function login(sessionUrl $sessionUrl)
	{
		// Redirect to start if user already logged in
		if(Auth::check()) return redirect('/');

		$sessionUrl->setPreviousUrl();

		$phpBBforum = Config::get('phpBBforums');

		return view('account.auth.login', ['phpBBforums' => $phpBBforum]);
	}

	public function loginPost(sessionUrl $sessionUrl, Requests\auth\loginRequest $request)
	{
		Log::debug('AccountController->loginPost');
		//TODO:Add validation for input
		//Check if user already logged in
		if(Auth::check()) redirect('/');

		//http://scotch.io/tutorials/simple-and-easy-laravel-login-authentication

		// Get and set remember
		$request->has('remember') ? $remember = true : $remember = false;

		// attempt to do the login
		if (Auth::attempt([ 'email' => $request->get('email'), 'password' => $request->get('password')], $remember))
		{
			// login successful!
			return $sessionUrl->redirectToPreviousUrlOrDefault();
		}
		else
		{
			// validation not successful, send back to form
			return redirect()->route('accounts.login')
				->withInput()
				->with('alert', 'Inloggningen misslyckades');
		}
	}

	public function logout()
	{
		//TODO: refactor to sessionUrl
		Auth::logout();
		return Redirect::to(URL::previous());
	}
}
