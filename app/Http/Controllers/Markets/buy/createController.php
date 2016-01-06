<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-01-03
 * Time: 01:49
 */

namespace market\Http\Controllers\Markets\buy;


use market\helper\markets\buy;
use market\Http\Controllers\Markets\baseCreateController;

class createController extends baseCreateController
{
    public function __construct()
    {
        $this->marketHelper = new buy();
    }
}