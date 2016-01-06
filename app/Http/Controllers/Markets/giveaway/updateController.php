<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-01-03
 * Time: 13:26
 */

namespace market\Http\Controllers\Markets\giveaway;


use market\helper\markets\giveaway;
use market\Http\Controllers\Markets\baseUpdateController;

class updateController extends baseUpdateController
{
    public function __construct()
    {
        $this->marketHelper = new giveaway();
    }
}