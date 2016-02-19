<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-10-05
 * Time: 22:48
 */

namespace market\ViewComposers;


use Illuminate\View\View;
use market\core\time;
use market\core\urlParam;

class all
{
    protected $time;

    public function __construct(urlParam $urlParam, time $time)
    {
        $this->time = $time;
        $this->urlParam = $urlParam;
//        dd('all view composer', $this->time);
    }

    public function compose(View $view)
    {
        $view->with('time', $this->time);
        $view->with('urlParam', $this->urlParam);
    }
}