<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-01-03
 * Time: 13:24
 */

namespace market\Http\Controllers\Markets\sell;


use market\helper\markets\sell;
use market\Http\Controllers\Markets\baseReadController;

class readController extends baseReadController
{
    public function __construct()
    {
        $this->marketHelper = new sell();
    }
}