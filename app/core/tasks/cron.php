<?php
///**
// * Created by PhpStorm.
// * User: Oskar
// * Date: 2016-02-21
// * Time: 13:34
// */
//
//namespace market\core\tasks;
//
//
//use Carbon\Carbon;
//use Illuminate\Support\Facades\Log;
//use market\core\time;
//use market\models\phpBBconnect;
//
//class cron
//{
//    protected $time;
//
//    public function __construct(time $time)
//    {
//        $this->time = $time;
//    }
//
////    public function cleanOldPhpBBConnect()
////    {
////        $timestamp = Carbon::createFromTimestamp(time());
////        $timestamp->addMinute(config('market.phpBBconnectValidMinutes'));
////
////        $deleted = phpBBconnect::where('created_at', '<', $timestamp)->delete();
////        if($deleted > 0)
////        {
////            Log::info('Deleted old phpBBconnect: ' . $deleted);
////        }
////    }
//
////    public function deleteOldTempImages()
////    {
////        //TODO: Inject
////        $d = new deleteOldTempImages();
////        $d->clean();
////    }
//
////    public function endOldAuctions()
////    {
////        //TODO: Inject
////        $endOldAuctions = new endOldAuctions();
////        $endOldAuctions->end();
////    }
//}