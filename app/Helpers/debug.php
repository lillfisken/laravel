<?php namespace market\helper;

use Illuminate\Support\Facades\Config;


class debug
{
    public static function logConsole($text)
    {
//        dd($text);
//        if(Config::get('app.debug')=='true')
//        {
            echo '<script>console.log("' . $text . '")</script>';
//        }
    }

}