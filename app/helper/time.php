<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-10-05
 * Time: 22:14
 */

namespace market\helper;


class time {

    public function __construct()
    {
        date_default_timezone_set(env('TIMEZONE', 'Europe/Stockholm'));
    }

    public function getTimeUnix()
    {
        return time();
    }

    public function getTimeString()
    {
        return date('H:i:s', time());
    }

    public function getTimeAndDateString()
    {
        abort(501);
    }

    public function parseTimeFromStringToUnix()
    {
        abort(501);
    }

    public function parseTimeAndDateFromStringToUnix($timeAndDate)
    {
        return strtotime($timeAndDate);
    }

    public function parseTimeFromUnixToString()
    {
        abort(501);
    }

    public function parseTimeAndDateFromUnixToString($unixTime)
    {
        return date('H:i:s', $unixTime);
    }
}