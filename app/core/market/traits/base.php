<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-08
 * Time: 16:21
 */

namespace market\core\market\traits;


trait base
{
//    public function getRouteBase()
//    {
//        return $this->routeBase;
//    }

    public function getMarketType()
    {
        return $this->marketType;
    }

    public function getTitleNew()
    {
        return $this->titleNew;
    }
}