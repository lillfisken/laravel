<?php namespace market\helper;

class marketType
{
    //TODO:Comments

    private static $typesAll = [
        '0' => 'Säljes',
        '1' => 'Köpes',
        '2' => 'Bytes',
        '3' => 'Skänkes',
        '4' => 'Samköp',
        '5' => 'Tjänst erbjudes',
        '6' => 'Tjänst sökes ',
        '7' => 'Anställning',
        '8' => 'Tips',
    ];

    private static $typesMarket = [
        '0' => 'Säljes',
        '1' => 'Köpes',
        '2' => 'Bytes',
        '3' => 'Skänkes',
    ];

//    public function __construct()
//    {
//        self::$typesAll = [
//            '0' => 'Säljes',
//            '1' => 'Köpes',
//            '2' => 'Bytes',
//            '3' => 'Skänkes',
//            '4' => 'Samköp',
//            '5' => 'Tjänst erbjudes',
//            '6' => 'Tjänst sökes ',
//            '7' => 'Anställning',
//            '8' => 'Tips',
//        ];
//
//        self::$this->typesMarket = [
//            '0' => 'Säljes',
//            '1' => 'Köpes',
//            '2' => 'Bytes',
//            '3' => 'Skänkes',
//        ];
//    }

    public static function getAllTypes()
    {
        return self::$typesAll;
    }

    public static function getTypesMarket()
    {
        return self::$typesMarket;
    }

    public static function getTypeName($number)
    {
        if(self::$typesAll[$number] != null)
        {
            return self::$typesAll[$number];
        }
        else
        {
            abort('404', 'Number is not a market type');
        }
    }
}

