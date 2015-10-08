<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-10-05
 * Time: 22:48
 */

namespace market\ViewComposers;


use Illuminate\View\View;
use market\helper\time;

class all
{
    public function compose(View $view)
    {
        $view->with('time', new time());
    }
}