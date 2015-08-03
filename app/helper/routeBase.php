<?php namespace market\helper;

class routeBase
{
    protected static $routeBases = [
        '0' => 'sell',
        '1' => 'buy',
        '2' => 'change',
        '3' => 'giveaway',
        '4' => 'auction',
    ];

    protected static $marketTypes = [
        '0' => 'Säljes',
        '1' => 'Köpes',
        '2' => 'Bytes',
        '3' => 'Skänkes',
        '4' => 'Auktion',
    ];

    public static function getRouteBase($id){
        return self::$routeBases[$id];
    }

    public static function getRouteBases()
    {
        return self::$routeBases;
    }
}