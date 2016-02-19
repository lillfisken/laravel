<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-15
 * Time: 22:04
 */

namespace market\core\market\create;


use market\core\interfaces\iMarketCreate;

class auction extends base implements iMarketCreate
{
    use \market\core\market\traits\auction;
}