<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-10
 * Time: 23:21
 */

namespace market\core\market\update;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use market\core\image;
use market\core\interfaces\iMarketHelper;
use market\core\interfaces\iMarketUpdate;
use market\core\session;
use market\core\text;
use market\models\Market;

class sell extends base implements iMarketUpdate
{
    use \market\core\market\traits\sell;

    public function __construct(text $text, image $image)
    {
        parent::__construct($text, $image);
    }

}