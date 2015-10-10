<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-10-05
 * Time: 22:14
 */

namespace market\helper;


class time {

    protected $timeFormat = 'H:i';
    protected $timeAndDateFormat = 'Y-m-d H:i';

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
//        dd('time, get time string', date('H:i:s', time()));
        return date($this->timeFormat, time());
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

    public function parseTimeFromUnixToString($unixTime)
    {
        return date($this->timeFormat, $unixTime);
    }

    public function parseTimeAndDateFromUnixToString($unixTime)
    {
        return date($this->timeAndDateFormat, $unixTime);
    }
}