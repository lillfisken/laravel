<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-01-03
 * Time: 01:49
 */

namespace market\Http\Controllers\Markets\sell;


use Chromabits\Purifier\Purifier;
use Illuminate\Http\Request;
use market\helper\markets\sell;
use market\Http\Controllers\Markets\baseCreateController;
//use market\Http\Requests\Request;

class createController extends baseCreateController
{
    public function __construct()
    {
        $this->marketHelper = new sell();
    }

    public function createFromForm(Request $request, Purifier $purifier)
    {
        return parent::createFromForm($request, $purifier);
    }

    public function createFromPreview(Request $request, Purifier $purifier)
    {
        return parent::createFromPreview($request, $purifier);
    }
}