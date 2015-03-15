<?php namespace market\helper;

class marketEndReason
{
    //TODO:Comments

    private static $typesAll = [
        '0' => 'Såld/Skänkt',
        '1' => 'Slängd',
        '2' => 'Återtagen',
        '3' => 'Övrigt'
    ];

    public static function getAllTypes()
    {
        return self::$typesAll;
    }

    public static function getTypeName($number)
    {
        if(self::$typesAll[$number] != null)
        {
            return self::$typesAll[$number];
        }
        else
        {
            abort('404', 'Number is not a market end type');
        }
    }
}

