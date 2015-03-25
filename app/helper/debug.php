<?php namespace market\helper;

use Illuminate\Support\Facades\Config;


class debug
{
    public static function logConsole($text)
    {
//        echo '<script>console.log("-----------------------")</script>';

        if(Config::get('app.debug'))
        {
            echo '<script>console.log("' . $text . '")</script>';
        }

        //dd('debug: ' . Config::get('app.debug') . '|, text: ' . $text . '|');

    }

}