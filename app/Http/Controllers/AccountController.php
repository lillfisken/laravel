<?php namespace market\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Session;
use market\helper\debug;
use market\Http\Requests;
use market\Http\Controllers\Controller;

use Illuminate\Contracts\Auth\Authenticator;
use Auth;
use Input;
use market\Http\Requests\passwordRequest;
use market\Http\Requests\registerRequest;
use market\Http\Requests\UserSettingsRequest;
use market\Market;
use Redirect;
use market\User;
use Illuminate\Http\Request;
use DB;
use Hash;
use market\helper\text;
use market\helper\marketMenu;

//use Illuminate\Contracts\Auth\Guard;
//use Illuminate\Contracts\Auth\Registrar;


class AccountController extends Controller
{
    //region login/logout
    public function login()
    {
        Session::put('uri', Session::get('_previous'));

        return view('account.auth.login');
    }

    public function loginPost()
    {
        //TODO:Add validation for input
        //TODO:Check if user already logged in

        //http://scotch.io/tutorials/simple-and-easy-laravel-login-authentication

        $remember = false;

        if (Input::has('remember')) {
            $remember = true;
        }

        // attempt to do the login
        if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')), $remember)) {

            // validation successful!
            // redirect them to the secure section or whatever
            // return Redirect::to('secure');
            // for now we'll just echo success (even though echoing in a controller is bad)
            //return 'SUCCESS!';

//            return Redirect::back();
            $uri = Session::get('uri');
            if(isset($uri))
            {
                if(isset($uri['url']))
                {
                    //dd($uri['url']);
                    return redirect($uri['url']);
                }
                return redirect()->route('markets.index');
            }
            else
            {
                return redirect()->route('markets.index');
            }

        } else {

            // validation not successful, send back to form
            return Redirect::route('accounts.login')->with(Input::all())->with('message', 'Inloggningen misslyckades');
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

    //endregion

    //region Register

    public function register()
    {
        return view('account.auth.register');
    }

    public function registerPost(registerRequest $request)
    {
        //TODO:Purify

//        //Save new user
//        $temp = new User;
//        $temp->name = Input::get('name');
//        $temp->email = Input::get('email');
//
//        $temp->username = Input::get('username');
//        $temp->address = Input::get('address');
//        $temp->city = Input::get('city');
//        $temp->zipcode = Input::get('zipcode');
//        $temp->phone1 = Input::get('phone1');
//        $temp->phone2 = Input::get('phone2');
//
//        $temp->password = Hash::make(Input::get('password'));
//
//        $temp->save();

        $newUser = new User($request->all());
        $newUser->password = Hash::make($request->input('password'));
        $newUser->username = $request->input('username');
        $newUser->save();

//        dd($newUser);

        //Login user
        Auth::login($newUser);

        //TODO:Sen email to new user, test if this is working...
        Mail::send('emails.auth.register', ['user' => $newUser], function($message, $newUser)
        {
            $message->to($newUser->email, $newUser->username)->subject('Välkommen!');
        });

        return redirect()->route('markets.index')->with('message', 'Användare skapad');
    }

//    public function forgotPassword()
//    {
////        dd('AccountController -> forgotPassword');
//
//        return view('account.auth.reset');
//    }


//endregion

    //---------------------------------------------------------------

    //region Profile

    /* Show user profile
     *
     * get 'profile/{user}'
     * route 'accounts.profile'
     * middleware 'auth'
     *
     * @var user
     * @return
    */
    public function show($user)
    {
        //TODO::Change to show public userprofile

//        dd($user);

        $activeMarkets = Market::where('createdByUser', $user->id)->paginate(5);
        foreach($activeMarkets as $market)
        {
            marketMenu::addMarketMenu($market);

        }

        $inactiveMarkets = Market::where('createdByUser', $user->id)->onlyTrashed()->paginate(5);
        foreach($inactiveMarkets as $market)
        {
            marketMenu::addMarketMenu($market);

        }
        dd($activeMarkets, $inactiveMarkets);

//        dd($user);

        return view(
            'account.profileView.userProfile',
            [
                'user' => $user,
                'activeMarkets' => $activeMarkets,
                'inactiveMarkets' => $inactiveMarkets
            ]
        );
//        $markets = Market::where('createdByUser', '=', Auth::id())->get();
//        $user = User::find(Auth::id())->first();
////        dd($markets);
//
//        $trashed = Market::onlyTrashed()->where('createdByUser', '=', Auth::id())->get();

//        return view('account.profileView.userProfile', ['user' => $user, 'markets' => $markets]);


    }

    //endregion

    //region Market Blocking

    /* Block market in logged in users lists
     *
     * get 'profile/blockmarket/{market}'
     * route 'accounts.blockMarket'
     * middleware 'auth'
     *
     * @var market to block
     * @return
    */
    public function blockMarket($market)
    {
        dd('accounts.blockMarket');
    }

    /* Show user profile
         *
         * get 'profile/unblockmarket/{market}'
         * route 'accounts.unblockMarket'
         * middleware 'auth'
         *
         * @var user
         * @return
        */
    public function unblockMarket($market)
    {
        dd('accounts.unblockMarket');
    }

    /* Show user profile
             *
             * get 'profile/blockseller/{user}'
             * route 'accounts.blockSeller'
             * middleware 'auth'
             *
             * @var user
             * @return
            */
    public function blockSeller($user)
    {
        dd('profile/blockseller/{user}');
    }

    /* Show user profile
             *
             * get 'profile/unblockseller/{user}'
             * route 'accounts.unblockSeller'
             * middleware 'auth'
             *
             * @var user
             * @return
            */
    public function unblockSeller($user)
    {
        dd('accounts.unblockSeller');
    }

    //endregion

    //region Market listings

    /* Show user profile
             *
             * get 'profile/watched/{user}'
             * route accounts.watched'
             * middleware 'auth'
             *
             * @var user
             * @return
            */
    public function watched($user)
    {
        return view('account.markets.watched');
    }

    /* Show user profile
             *
             * get 'profile/active/{user}'
             * route 'accounts.active'
             * middleware 'auth'
             *
             * @var user
             * @return
            */
    public function active()
    {
        //dd('AccountController@active');

        $markets = Market::where('createdByUser', Auth::id())->get();
        //TODO: Market menus
        foreach($markets as $market)
        {
            marketMenu::addMarketMenu($market);
        }
//        foreach ($markets as $market) {
//            $temp[] = array('text' => 'Redigera', 'href' => route('markets.edit', $market->id));
//            $temp[] = array('text' => 'Avslutad', 'href' => route('markets.delete', $market->id));
//
//            $market['marketmenu'] = $temp;
//        }

        return view('account.markets.active', ['markets' => $markets]);
    }

    /* Show user profile
             *
             * get 'profile/trashed/{user}'
             * route 'accounts.trashed'
             * middleware 'auth'
             *
             * @var user
             * @return
            */
    public function trashed()
    {
        //dd('AccountController@trashed');
        $markets = Market::onlyTrashed()->where('createdByUser', Auth::id())->get();
        //TODO: Add market menu

//        foreach ($markets as $market) {
//            $temp[] = array('text' => 'Aktivera', 'href' => route('markets.reactivate', $market->id));
//
//            $market['marketmenu'] = $temp;
//
//        }

        return view('account.markets.trashed', ['markets' => $markets]);
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
    public function blockedmarket($user)
    {
        //dd('AccountController@blockedmarked');

        return view('account.markets.blockedMarkets');
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
    public function blockedseller($user)
    {
//        dd('AccountController@blockedseller');

        return view('account.markets.blockedSellers');
    }

    //endregion

    //region settings

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
    public function saveSettings(UserSettingsRequest $userSettingsRequest)
    {
        $user = Auth::user();

        $input = $userSettingsRequest->all();
        $input['presentation'] = text::bbCodeToHtml($input['presentation']);

        //TODO: Purify input

        $user->fill($input);

        $user->save();

        $user['presentation'] = text::htmlToBbCode($user['presentation']);

        return view('account.settings.settings', ['user' => $user])->withMessage('Inställningar sparade');
    }

    public function newPassword()
    {
        return view('account.settings.newPassword', ['user' => Auth::user()]);
    }

    public function newPasswordPost(passwordRequest $passwordRequest )
    {
        //TODO: Move password verification to custom rule in request

        if(Hash::check($passwordRequest->input('pswdOld'), Auth::user()->password))
        {
            //User entered correct password
            $user = Auth::user();
            $user->password = Hash::make($passwordRequest->input('password'));
            $user->save();
            return Redirect::route('accounts.settings.password')->withMessage('Lösenord ändrat');
        }
        else
        {
//            dd(Redirect::back()->withError(['pswdOld' => 'Fel lösenord']));
            return Redirect::back()->with('pswdOld' , 'Fel lösenord');
        }


    }

    //endregion

}

