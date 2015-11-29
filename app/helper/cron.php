<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-10-04
 * Time: 22:50
 */

namespace market\helper;


use Illuminate\Support\Facades\Log;
use market\core\tasks\deleteOldTempImages;
use market\core\tasks\endOldAuctions;

class cron {

    protected $time;

    public function __construct()
    {
        $this->time = new time();
    }

    public function cleanOldPhpBBConnect()
    {
        //TODO: delete old php connect
    }

    public function deleteOldTempImages()
    {
        //TODO: Inject
        $d = new deleteOldTempImages();
        $d->clean();
    }

    public function endOldAuctions()
    {
        //TODO: Inject
        $endOldAuctions = new endOldAuctions();
        $endOldAuctions->end();
    }
}