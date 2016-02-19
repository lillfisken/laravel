<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-08
 * Time: 16:35
 */

namespace market\core\market\traits;


trait buy
{
    protected $routeBase = 'buy';
    protected $marketType = 1;
    protected $titleNew = 'Ny köpesannons';

    use base;
}