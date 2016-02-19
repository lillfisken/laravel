<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-15
 * Time: 21:40
 */

namespace market\core\market\update;


use market\core\image;
use market\core\interfaces\iMarketUpdate;
use market\core\text;

class buy extends base implements iMarketUpdate
{
    use \market\core\market\traits\buy;

    public function __construct(text $text, image $image)
    {
        parent::__construct($text, $image);
    }
}