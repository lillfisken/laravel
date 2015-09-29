<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-09-27
 * Time: 23:07
 */

namespace market\helper;


use Illuminate\View\View;

class menu {

    public function __construct()
    {

    }

    public function getTime()
    {
        return time();
    }

    public function compose(View $view)
    {
        $view->with('time', date('H:i:s'));
    }

}