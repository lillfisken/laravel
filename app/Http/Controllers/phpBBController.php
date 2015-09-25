<?php namespace market\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use market\Http\Requests;
use market\Http\Controllers\Controller;

use Illuminate\Http\Request;
use market\phpBBconnect;
use market\phpBBUsers;
use market\User;
use Zjango\Laracurl\Facades\Laracurl;

class phpBBController extends Controller {

    public function externalResponse($key, Request $request)
    {
        Log::debug('phpBBController -> external response');
        $response = [];
        $response['function'] = 'externalResponse';

        $phpConnect = phpBBconnect::where('token', $key)->get()->first();


        if($phpConnect != null)
        {
            Log::debug('external response -> phpConnect is not null');

            // Token is ok!

            // All data we need is here?
            if(!$request->has('username'))
            {
                return new Response('missing parameter', 400);
            }
            $username = $request->get('username');

            if($phpConnect->register == 1)
            {
                Log::debug('phpBBController -> register is true');

                //TODO: Check if auth:id and forum exist in db, then change username
                // Check if user already registered, then change username --------------------------------------
                $phpUserDb = phpBBUsers::where('forumKey', $phpConnect->forumKey)
                    ->where('user', $phpConnect->user)
                    ->get()
                    ->first();

                Log::debug('phpBBController -> we got a phpUserDb: ' . $phpUserDb);

                if($phpUserDb)
                {
                    Log::debug('phpBBController -> phpUserDb in if statement');
                    Log::debug('phpBBController -> $phpUserDb->username: ' . $phpUserDb->username);
                    Log::debug('phpBBController -> $phpConnect->username: ' . $phpConnect->username);
                    Log::debug('phpBBController -> $request->username: ' . $username);

                    $phpUserDb->username = $username;
                    if($phpUserDb->save())
                    {
                        return new Response('Success', 200);
                    }
                    else
                    {
                        return new Response('Couldnt update username', 500);
                    }
                }
                // ---------------------------------------------------------------------------------------------

                // Create new user connection in DB
                $response['register'] = 'true';

                $user = [];
                $user['forumKey'] = $phpConnect->forumKey;
                $user['user'] =  $phpConnect->user;
                $user['username'] = $username;

                $response['user'] = $user;

                $phpUser = new phpBBUsers($user);
                if($phpUser->save())
                {
                    return new Response('Success', 200);
                }
                else
                {
                    return new Response('duplicate entry', 500);
                }
            }
            else if( $phpConnect->login == 1)
            {
                Log::debug('phpBBController -> Login is true');

                $phpUser = phpBBUsers::where('username', $request->get('username'))
                    ->where('forumKey', $phpConnect->forumKey)
                    ->get()->first();
//
//                $response['register'] = 'false';
//                $response['phpUser'] = $phpUser;

                if($phpUser == null)
                {
                    Log::debug('phpBBController -> phpUser = null');
                    return new Response('missing user', 400);
                }
                else
                {
                    Log::debug('$phpUser->user: ' . $phpUser->user);

//                    $userThis = User::where('id', $phpUser->user);
//                    $response['userThis'] = $userThis;
                    //TODO: Set user to be logged in at redirection back (add in db)
                    $phpConnect->user = $phpUser->user;
                    $phpConnect->save();

                    return new Response('Success', 200);
                }
            }
        }

        Log::debug('phpBBController -> returning 500');
        return new Response('Error', 500);
    }

    protected function getForumById($id)
    {
        $forums = Config::get('phpBBforums');

        foreach($forums as $forum)
        {
            if($forum['id'] == $id)
            {
                return $forum;
            }
        }

        // We couldn't match the forumId to any forum
        return new Response('No forum', 400);
    }

    protected function generateToken()
    {
        return substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',10)),0,255);
    }

//    protected function connectToPhpBB($forum)
//    {
//        $forumKey = $forum['key'];
//        $token = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',10)),0,255);
//        $urlConnect = $forum['urlConnect'];
//
//        $response = Laracurl::post($urlConnect, ['forumKey' => $forumKey, 'token' => $token]);
////        $response = Laracurl::jsonPost($urlConnect, ['forumKey' => $forumKey, 'token' => $token]);
//
//        $responseDecoded = json_decode($response);
//
//        if($response->statusCode == 201 && $token == $responseDecoded->token)
//        {
//            //TODO: Store token, forumkey, action(login, register), redirectAfterUrl ??? in db
//
////            dd($responseDecoded->url);
////            dd(redirect($responseDecoded->url));
//            return redirect($responseDecoded->url);
////            return redirect('https://www.google.se/');
//
////            dd('Matches');
//
//        }
//
//        abort(400);
//
//        //TODO: Redirect user to url in response
//
//        dd($forum, $urlConnect, $forumKey, $token, $response, json_decode($response), $response->statusCode);
//    }

    public function registerUser($forumId)
    {
        // Get data
        // Store data in DB
        // Send connect request
        // check response
        // Redirect to url in response

        $forum = $this->getForumById($forumId);
//        if($forum ==null)
//        {
//            // We couldn't match the forumId to any forum
//            return new Response('Forum', 400);
//        }

        $new = [];
        $new['token'] = $this->generateToken();
        $new['forumKey'] = $forum['key'];
        $new['register'] = 1;
        $new['user'] = Auth::id();
        $new['url'] = URL::previous();
//        dd($new);

        $phpBBRegister = new phpBBconnect($new);
        if($phpBBRegister->save())
        {
            // Create and redirect
            $response = Laracurl::post($forum['urlConnect'], [
                'forumKey' => $phpBBRegister['forumKey'],
                'token' => $phpBBRegister['token']
            ]);
        }
        else
        {
            return new Response('Error register request', 500);
        }

        $responseDecoded = json_decode($response);

        if($response->statusCode == 201 &&
            $responseDecoded->token == $phpBBRegister['token'])
        {
            return redirect($responseDecoded->url);
        }
        else
        {
            return new Response('Bad response from forum', 500);
        }
    }

    public function loginUser($forumId)
    {
        $forum = $this->getForumById($forumId);

        $new = [];
        $new['token'] = $this->generateToken();
        $new['forumKey'] = $forum['key'];
        $new['register'] = 0;
        $new['login'] = 1;
//        $new['user'] = Auth::id();
        $new['url'] = URL::previous(); //TODO: Check flashed for redirection url

//        dd('loginUser', $new);

        $phpBBLogin = new phpBBconnect($new);
        if($phpBBLogin->save())
        {
            $response = Laracurl::post($forum['urlConnect'], [
                'forumKey' => $phpBBLogin['forumKey'],
                'token' => $phpBBLogin['token']
            ]);
        }
        else
        {
            return new Response('Error register request', 500);
        }


        $responseDecoded = json_decode($response);

        if($response->statusCode == 201 &&
            $responseDecoded->token == $phpBBLogin['token'])
        {
            return redirect($responseDecoded->url);
        }
        else
        {
            return new Response('Bad response from forum', 500);
        }
    }

    public function redirected($token)
    {
        $phpConnect = phpBBconnect::where('token', $token)->get()->first();

        if($phpConnect != null)
        {
            if($phpConnect->login)
            {
                //TODO: Get user id from username and login + some verifikation
                // If username and forumkey matches...
                // Abort 404, 'User not found'
//                dd('Login id', $phpConnect->token, $phpConnect->user, $phpConnect);

                Auth::loginUsingId($phpConnect->user);
//
//                dd('Login', $phpConnect, Auth::user());
                //TODO: Login user
            }

            $url = $phpConnect->url;

            //Delete "session"
            $phpConnect->delete();

            if($url != null)
            {
                return redirect($url);
            }
            else
            {
                return redirect('/');
            }
        }
        abort(404);
    }
}
