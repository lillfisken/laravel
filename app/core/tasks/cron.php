<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-21
 * Time: 13:34
 */

namespace market\core\tasks;


use market\core\time;

class cron
{
    protected $time;

    public function __construct(time $time)
    {
        $this->time = $time;
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