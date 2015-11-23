<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-11-23
 * Time: 20:01
 */

namespace market\core\session;


use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class sessionUrl
{
    public function setPreviousUrl($url = null)
    {
        if(!$url)
        {
            $url = URL::previous();
        }
        Session::put('previousUrl', $url);
    }

    public function redirectToPreviousUrlOrDefault()
    {
//        dd('redirectToPreviousUrlOrDefault', Session::get('previousUrl'));
        $redirectUrl = Session::get('previousUrl');
        Session::forget('previousUrl');

        if($redirectUrl)
        {
            return redirect($redirectUrl);
        }
        else
        {
            return redirect('/');
        }
    }
}