<?php namespace market\helper;

use Illuminate\Support\Facades\Config;


class debug
{
    public static function logConsole($text)
    {
//        dd('btvdnuxikbfnox');
//        if(Config::get('app.debug')=='true')
//        {
            echo '<script>console.log("' . $text . '")</script>';
//        }
    }

}