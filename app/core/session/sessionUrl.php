<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-11-23
 * Time: 20:01
 */

namespace market\core\session;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class sessionUrl
{
    protected $previousName; //Variable name in session

    public function __construct()
    {
        $this->previousName = 'previousUrl';
    }

    public function setPreviousUrl($url = null)
    {
        Log::debug('sessionUrl->setPreviousUrl');
        Log::debug('$url = ' . $url);
        Log::debug('Url from session = ' . Session::get($this->previousName));
        if($url == null)
        {
//            $fromSession = Session::get($this->previous);
//            Log::debug('$url is not null');
            if(!Session::has($this->previousName))
            {
//                Log::debug('session has previous. Previuous = ' . Session::get($this->previousName));
//                //Keep previous url
////                dd(
////                    'has prev',
////                    Session::all(),
////                    Session::get($this->previousName)
////                );
////                $this->setPreviousUrl(Session::get($this->previousName));
//            }
//            else
//            {
                Log::debug('Setting previous from request. Previous = ' . URL::previous());
                $this->setPreviousUrl(URL::previous());
            }

        }
        else
        {
            Log::debug('Put $url in session');
            Session::put($this->previousName, $url);
        }

//        dd(
//            $this->previous,
//            Session::put($this->previous, 'hbcnjiskl'),
//            Session::has($this->previous),
//            Session::get($this->previous),
//            Session::put($this->previous, null)
//        );
    }

    public function redirectToPreviousUrlOrDefault()
    {
        Log::debug('sessionUrl->redirectToPreviousUrlOrDefault');

//        dd('redirectToPreviousUrlOrDefault', Session::get('previousUrl'));
        $redirectUrl = Session::get($this->previousName);
        Session::forget($this->previousName);

        if($redirectUrl)
        {
            return redirect($redirectUrl);
        }
        else
        {
            return redirect('/');
        }
    }

    public function clearPrevious()
    {
        Session::forget($this->previousName);
    }
}