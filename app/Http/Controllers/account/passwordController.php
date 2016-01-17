<?php namespace market\Http\Controllers\account;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use market\helper\debug;
use market\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use market\models\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PasswordController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/

	use ResetsPasswords;

	/**
	 * Create a new password controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\PasswordBroker  $passwords
	 * @return void
	 */
	public function __construct(Guard $auth, PasswordBroker $passwords)
	{
		$this->auth = $auth;
		$this->passwords = $passwords;

		$this->middleware('guest');
	}

    /**
     * Display the form to request a password reset link.
     *
     * @return Response
     */
    public function getEmail()
    {
        return view('account.auth.emailNewPassword');
    }

    public function postEmail(Request $request)
    {
        //Change request to validate
        //Create password link
        //Create email
        //Send email
        //Redirect Back with message if succsess: Meddelande skickat

        //add route to handle reset link



        $this->validate($request, ['email' => 'required|email']);

        $response = $this->passwords->sendResetLink($request->only('email'), function($m)
        {
            $m->subject($this->getEmailSubject());
        });

        switch ($response)
        {
            case PasswordBroker::RESET_LINK_SENT:
                return redirect()->back()->with('message', 'E-mail skickat');

            case PasswordBroker::INVALID_USER:
                return redirect()->back()->withErrors(['email' => trans($response)]);
        }

    }

    /**
     * Get the e-mail subject line to be used for the reset link email.
     *
     * @return string
     */
    protected function getEmailSubject()
    {
        return isset($this->subject) ? $this->subject : 'Your Password Reset Link';
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string  $token
     * @return Response
     */
    public function getReset($token = null)
    {
//        dd($token);
        if (is_null($token))
        {
            throw new NotFoundHttpException;
        }

        return view('account.auth.resetPassword')->with('token', $token);
    }

    /**
     * Reset the given user's password.
     *
     * @param  Request  $request
     * @return Response
     */
    public function postReset(Request $request)
    {
        $pwReset = DB::table(Config::get('auth.password.table'))->where('token', $request->get('token'))->first();

        if($pwReset===null)
        {
            //If token is not set in DB
            //TODO: Redirecta till något vettigt med message
            dd('Ogiltlig länk');
        }
        elseif(time() - strtotime($pwReset->created_at) > Config::get('auth.password.expire') * 60)
        {
            //If token is more than expiration time set in auth.config

            //Todo: redirecta back med meddelande om utgången länk
            dd('Länken utgången');
        }
        else
        {
            //Token and everting else is valid, let's change the password

            $user = User::where('email', '=', $pwReset->email)->firstOrFail();

            $user->password = Hash::make($request->get('password'));
            $user->save();

            Auth::login($user);

            //TODO: Send user email about password has been changed

            return redirect()->route('markets.index')->with('message', 'Lösenordet ändrat');
        }
    }

}
