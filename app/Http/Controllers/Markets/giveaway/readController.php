<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-01-03
 * Time: 13:24
 */

namespace market\Http\Controllers\Markets\giveaway;


use market\helper\markets\giveaway;
use market\Http\Controllers\Markets\baseReadController;

class readController extends baseReadController
{
    public function __construct()
    {
        $this->marketHelper = new giveaway();
    }
}