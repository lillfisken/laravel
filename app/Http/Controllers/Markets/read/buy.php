<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-18
 * Time: 19:25
 */

namespace market\Http\Controllers\Markets\read;


use market\core\market\marketPrepare;
use market\core\market\marketType;
use market\core\market\read\buy as buyRead;
use market\Http\Controllers\Controller;

class buy extends Controller
{
    use base;

    protected $marketHelper;
    protected $marketType;
    protected $marketPrepare;

    public function __construct(buyRead $sell, marketType $marketType, marketPrepare $marketPrepare)
    {
        $this->marketHelper = $sell;
        $this->marketType = $marketType;
        $this->marketPrepare = $marketPrepare;
    }

    public function show($id)
    {
        return $this->baseShow($id, $this->marketHelper, $this->marketPrepare, $this->marketType);
    }
}