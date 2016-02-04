<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-12-27
 * Time: 19:33
 */

namespace market\core\market;


use Illuminate\Http\Request;

class marketType
{
    public function __construct()
    {
    }

    private $marketTypes = [
        '0' => 'Säljes',
        '1' => 'Köpes',
        '5' => 'Samköp',
        '2' => 'Bytes',
        '4' => 'Auktion',
    ];

    private $routeBases = [
        '0' => 'sell',
        '1' => 'buy',
        '2' => 'change',
        '4' => 'auction',
        '5' => 'buyGroup'
    ];

    public function getAllMarketTypes()
    {
        return $this->marketTypes;
    }

    public function getMarketTypeName($number)
    {
        if($this->marketTypes[$number] != null)
        {
            return $this->marketTypes[$number];
        }
        else
        {
            abort('404', 'Number is not a market type');
        }
    }

    public function setRouteBase($market)
    {
        if($this->routeBases[$market->marketType] != null)
        {
            return $market->routeBase = $this->routeBases[$market->marketType];
        }
        else
        {
            abort('404', 'This is not a market type');
        }
    }

    public function getRouteBase($marketTypeNumber)
    {
        return $this->routeBases[$marketTypeNumber];
    }

}