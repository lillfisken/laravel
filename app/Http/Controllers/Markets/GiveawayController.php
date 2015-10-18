<?php namespace market\Http\Controllers\Markets;

use Chromabits\Purifier\Purifier;
use market\Http\Requests;
use market\helper;

use Illuminate\Http\Request;

class GiveawayController extends BaseController {

    public function __construct(Purifier $purifier)
    {
        parent::__construct($purifier);

        $this->marketHelper = new helper\markets\giveaway();
    }

}
