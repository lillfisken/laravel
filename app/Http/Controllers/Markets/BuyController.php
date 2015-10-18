<?php namespace market\Http\Controllers\Markets;

use Chromabits\Purifier\Purifier;
use market\Http\Requests;

use Illuminate\Http\Request;
use market\helper;


class BuyController extends BaseController {

    public function __construct(Purifier $purifier)
    {
        parent::__construct($purifier);

        $this->marketHelper = new helper\markets\buy();
    }


}
