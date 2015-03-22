<?php namespace market\helper;

use Illuminate\Support\Facades\Config;


class debug
{
    public static function logConsole($text)
    {
        if(Config::get('app.debug'))
        {
            echo '<script>console.log("' . $text . '")</script>';
        }
    }

}