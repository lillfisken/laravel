<?php namespace market\Http\Controllers;

use market\Http\Requests;
use market\Http\Controllers\Controller;

use Illuminate\Contracts\Auth\Authenticator;
use Auth;
use Input;
use Redirect;


class AccountController extends Controller {

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

            //TODO:Add remember me
            // attempt to do the login
            if (Auth::attempt($userdata)) {

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

    public function registerPost()
    {
        //TODO:Add validation for input
        //TODO:Add registration logic

        //get user input
        //validate input
        //save input in db
        //log user in

        return 'registerPost';
    }

}
