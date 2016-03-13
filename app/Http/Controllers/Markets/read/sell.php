<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-15
 * Time: 23:29
 */

namespace market\Http\Controllers\Markets\read;


use market\core\market\marketPrepare;
use market\core\market\marketType;
use market\core\market\read\sell as readSell;
use market\Http\Controllers\Controller;

class sell extends Controller
{
    use base;

    protected $marketHelper;
    protected $marketType;
    protected $marketPrepare;

    public function __construct(readSell $sell, marketType $marketType, marketPrepare $marketPrepare)
    {
        $this->marketHelper = $sell;
        $this->marketType = $marketType;
        $this->marketPrepare = $marketPrepare;
    }

    public function show($id)
    {
//        dd('sellReadController');
        return $this->baseShow($id, $this->marketHelper, $this->marketPrepare, $this->marketType);
    }
}