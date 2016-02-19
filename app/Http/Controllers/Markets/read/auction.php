<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-18
 * Time: 22:13
 */

namespace market\Http\Controllers\Markets\read;


use market\core\market\marketPrepare;
use market\core\market\marketType;
use market\core\market\read\auction as auctionRead;
use market\Http\Controllers\Controller;

class auction extends Controller
{
    use base;

    protected $marketHelper;
    protected $marketType;
    protected $marketPrepare;

    public function __construct(auctionRead $auction, marketType $marketType, marketPrepare $marketPrepare)
    {
        $this->marketHelper = $auction;
        $this->marketType = $marketType;
        $this->marketPrepare = $marketPrepare;
    }

    public function show($id)
    {
        return $this->baseShow($id, $this->marketHelper, $this->marketPrepare, $this->marketType);
    }
}