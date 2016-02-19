<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-07
 * Time: 23:32
 */

namespace market\core\market\create;


use market\core\interfaces\iMarketCreate;

class sell extends base implements iMarketCreate
{
    use \market\core\market\traits\sell;
}