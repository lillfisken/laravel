<?php namespace market\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use market\helper\debug;
use market\helper\markets\common;
use market\Http\Requests;
use market\Http\Controllers\Controller;

use Illuminate\Contracts\Auth\Authenticator;
use Input;
use market\Http\Requests\passwordRequest;
use market\Http\Requests\registerRequest;
use market\Http\Requests\UserSettingsRequest;
use market\models\Market;
use market\models\phpBBUsers;
use market\models\watched;
use Redirect;
use market\models\User;
use Illuminate\Http\Request;
use DB;
use Hash;
use market\helper\text;
use market\helper\marketMenu;
use Symfony\Component\HttpFoundation\Response;
use Zjango\Laracurl\Facades\Laracurl;

class AccountController extends Controller
{
    protected $marketCommon;

    public function __construct()
    {
//        parent::__construct();
        $this->marketCommon = new common();

    }
    //region login/logout
    public function login()
    {
        //TODO: Redirect to index if user is logged in
        if(Auth::check())
        {
            return redirect('/');
        }

        Session::put('uri', Session::get('_previous'));

        $phpBBforum = Config::get('phpBBforums');

        return view('account.auth.login', ['phpBBforums' => $phpBBforum]);
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
        //TODO: Multiple pagination
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
//        dd($activeMarkets, $inactiveMarkets);
        $phpBBUsers = phpBBUsers::where('user', $user->id)->get();
        $phpBB = [];
        foreach($phpBBUsers as $phpBBUser)
        {
            $phpBB[] = [
                'forumName' => $this->getForumByKey($phpBBUser->forumKey)['displayName'],
                'username' => $phpBBUser->username,
                'url' => $phpBBUser->url,
            ];
        }
        //dd($phpBBUsers, $phpBB);
//        dd($user);

        return view(
            'account.profileView.userProfile',
            [
                'user' => $user,
                'activeMarkets' => $activeMarkets,
                'inactiveMarkets' => $inactiveMarkets,
                'phpBBs' => $phpBB,
                'marketCommon' => $this->marketCommon,
            ]
        );
//        $markets = Market::where('createdByUser', '=', Auth::id())->get();
//        $user = User::find(Auth::id())->first();
////        dd($markets);
//
//        $trashed = Market::onlyTrashed()->where('createdByUser', '=', Auth::id())->get();

//        return view('account.profileView.userProfile', ['user' => $user, 'markets' => $markets]);


    }

    protected function getForumByKey($key)
    {
        //TODO: Move this to helper
        $forums = Config::get('phpBBforums');

        foreach($forums as $forum)
        {
            if($forum['key'] == $key)
            {
                return $forum;
            }
        }

        // We couldn't match the forumId to any forum
        return new Response('No forum', 400);
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
    public function blockMarket(Request $request)
    {
        $market = $request->get('marketId');
        $user = Auth::id();
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

        $markets = Market::where('createdByUser', Auth::id())
//            ->groupBy('created_at')
//            ->get();
            ->paginate(config('market.paginationNr'));
        $markets->setPath(route('accounts.active'));

//        dd($markets, config('market.paginationNr') );

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

        return view('account.markets.active', [
            'markets' => $markets,
            'marketCommon' => $this->marketCommon,
        ]);
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
        $markets = Market::onlyTrashed()->where('createdByUser', Auth::id())
            ->paginate(config('market.paginationNr'));
        $markets->setPath(route('accounts.trashed'));

        foreach($markets as $market)
        {
            marketMenu::addMarketMenu($market);
        }

        return view('account.markets.trashed', [
            'markets' => $markets,
            'marketCommon' => $this->marketCommon,
        ]);
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

        abort(501);
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
        abort(501);
        return view('account.markets.blockedSellers');
    }

    //endregion

    //region Watched

    /* Show user profile
         *
         * get 'profile/watched/{user}'
         * route accounts.watched'
         * middleware 'auth'
         *
         * @var user
         * @return
        */
    public function watched()
    {
        $markets = Market::whereIn('id', watched::getAllMarketIdsWatchedByUserId(Auth::id()))
//            ->with('watched')
            ->paginate(config('market.paginationNr'));
        $markets->setPath(route('accounts.watched'));

//        dd($markets);

//        $watched_array = watched::getAllMarketIdsWatchedByUserId(Auth::id());
//
//        $markets = Market::whereIn('id', $watched_array)
//            ->paginate(config('market.paginationNr'));
//        $markets->setPath(route('accounts.active'));

        marketMenu::addMarketMenuToMarkets($markets);

        return view('account.markets.watched', [
            'markets' => $markets,
            'marketCommon' => $this->marketCommon,
        ]);
    }

    public function watchMarket(Request $request, $marketId)
    {
        $user = Auth::id();
//        $previousUrl = URL::previous();
        $market = Market::find($marketId);

        if($market)
        {
            return view('account.watched.watchConfirm')
                ->with('user', $user)
                ->with('market', $market);
        }
        else
        {
            abort(404);
        }
    }

    public function watchMarketPost(Request $request)
    {
        if($request->get('yes') && $request->get('marketId'))
        {
            $markets = watched::where('user', Auth::id())->get();
            $watched = new watched([
                'user' => Auth::id(),
                'market' => $request->get('marketId')
            ]);

            $watched->save();

            return redirect()->route('accounts.watched', [Auth::user()->username]);
        }
        else
        {
            abort(404);
        }

        dd($request->get('yes'), $request->get('marketId'), $request->all());
//        dd(Auth::user()->username);
    }

    //endregion

    //region Settings

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
        $checkboxes = [
            'mailNewPm',
            'mailNewBidMyAuction',
            'mailMyAuctionEnded',
            'mailAuctionWatched',
            'mailMarketEnded'
        ];

        foreach($checkboxes as $checkbox)
        {
            if(!$userSettingsRequest->has($checkbox))
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

    public function auth()
    {
        //Show user a page to manage external logins
        $user = User::where('id', Auth::id())->with('phpBBUsers')->get()->first();
        $forums = Config::get('phpBBforums');
        $forumsUser = $user->phpBBUsers;
        $phpBBNonRegistered = [];
        $phpBBRegistered = [];

        foreach($forums as $forum)
        {
            $match = false;
            foreach($forumsUser as $forumUser)
            {
                if($forum['key'] == $forumUser['forumKey'])
                {
                    $forum['username'] = $forumUser['username'];
                    array_push($phpBBRegistered, $forum);
                    $match = true;
                    break 1;
                }
            }
            if(!$match)
            {
                array_push($phpBBNonRegistered, $forum);
            }
        }
        return view('account.settings.oAuth', ['user' => $user,
            'phpBBRegistered' => $phpBBRegistered,
            'phpBBNonRegistered' => $phpBBNonRegistered]);
    }

    public function authPost()
    {

    }

    //endregion

}

