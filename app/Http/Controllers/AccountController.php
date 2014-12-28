<?php namespace market\Http\Controllers;

use market\Http\Requests;
use market\Http\Controllers\Controller;

use Illuminate\Contracts\Auth\Authenticator;
use Auth;
use Input;
use Redirect;
use market\User;
use Illuminate\Http\Request;
use DB;
use Hash;

//use Illuminate\Contracts\Auth\Guard;
//use Illuminate\Contracts\Auth\Registrar;


class AccountController extends Controller {

//    /*/**
//     * The Guard implementation.
//     *
//     * @var Guard
//     */
//    protected $auth;
//
//    /**
//     * The registrar implementation.
//     *
//     * @var Registrar
//     */
//    protected $registrar;
//
//    /**
//     * Create a new authentication controller instance.
//     *
//     * @param  Guard  $auth
//     * @return void
//     */
//    public function __construct(Guard $auth, Registrar $registrar)
//    {
//        $this->auth = $auth;
//        $this->registrar = $registrar;
//
//        $this->middleware('guest', ['except' => 'getLogout']);
//    }*/

    public function login()
    {
        return view('account.login');
    }

    public function loginPost()
    {
        //TODO:Add validation for input
        //TODO:Check if user already logged in

        //http://scotch.io/tutorials/simple-and-easy-laravel-login-authentication


//        // validate the info, create rules for the inputs
//        $rules = array(
//            'email'    => 'required|email', // make sure the email is an actual email
//            'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
//        );
//
//        // run the validation rules on the inputs from the form
//        $validator = Validator::make(Input::all(), $rules);
//
//        // if the validator fails, redirect back to the form
//        if ($validator->fails()) {
//            return Redirect::to('login')
//                ->withErrors($validator) // send back all errors to the login form
//                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
//        } else {

            // create our user data for the authentication
            $userdata = array(
                'email' 	=> Input::get('email'),
                'password' 	=> Input::get('password')
            );

            $remember = false;

            if(Input::has('remember'))
            {
                $remember = true;
            }

            //TODO:Add remember me
            // attempt to do the login
            if (Auth::attempt($userdata, $remember)) {

                // validation successful!
                // redirect them to the secure section or whatever
                // return Redirect::to('secure');
                // for now we'll just echo success (even though echoing in a controller is bad)
                //return 'SUCCESS!';

                return Redirect::to('/');

            } else {

                // validation not successful, send back to form
                return Redirect::route('accounts.login');
              //TODO:Add error message to redirect
            }

//        }

//        ---------------------------------------------
//        if (Auth::attempt(array('email' => $email, 'password' => $password)))
//        {
//            return 'logged in';
//            return Redirect::intended('dashboard');
//        }
//
//        return 'logging in failed';
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to('/');
    }

    public function register()
    {
        return view('account.register');
    }

    public function registerPost(Request $request, User $user)
    {
        //TODO:Add validation for input
        //TODO:Add registration logic, change Request to new UserNewRequest
        //TODO:Sen email to new user
        //TODO:Critical Prevent SQL-injection

        $temp = new User;
        $temp->name = Input::get('name');
        $temp->email = Input::get('email');

        $temp->username = Input::get('username');
        $temp->address = Input::get('address');
        $temp->city = Input::get('city');
        $temp->zipcode = Input::get('zipcode');
        $temp->phone1 = Input::get('phone1');
        $temp->phone2 = Input::get('phone2');

        $temp->password = Hash::make(Input::get('password'));

        $temp->save();

        //TODO: login new user and redirect to start with message "User created"

        return redirect()->route('markets.index');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  RegisterRequest  $request
     * @return Response
     */
//    public function postRegister(Request $request)
//    {
//        $validator = $this->registrar->validator($request->all());
//
//        if ($validator->fails())
//        {
//            $this->throwValidationException(
//                $request, $validator
//            );
//        }
//
//        $this->auth->login($this->registrar->create($request->all()));
//
//        return redirect($this->redirectPath());
//    }

    /*
     * Show user profile
    */
    public function show($user)
    {
        $tempuser = User::where('username' , $user)->firstOrFail();
        //dd($tempuser);
        return view('account.profile', ['user' => $tempuser]);
    }
}
