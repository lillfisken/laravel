<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-15
 * Time: 21:39
 */

namespace market\core\market\create;


use market\core\interfaces\iMarketCreate;

class buy extends base implements iMarketCreate
{
    use \market\core\market\traits\buy;
}