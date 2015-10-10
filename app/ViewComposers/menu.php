<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-09-27
 * Time: 23:07
 */

namespace market\ViewComposers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use market\Conversation;
use market\helper\time;
use market\Message;

class menu {

    protected $time;

    public function __construct()
    {
        $this->time = new time();
    }

//    public function getTimeAsString()
//    {
////        return time();
//        return $this->time->getTimeString();
//    }

    public function compose(View $view)
    {
//        $view->with('time', $this->getTimeAsString());

        if(Auth::check())
        {
            $unread = DB::table('conversations')
                ->join('messages', function($join){
                $join->on('conversations.id', '=', 'messages.conversationId')
                    ->where('conversations.user1', '=', Auth::id())
                    ->orWhere('conversations.user2', '=', Auth::id());
//                    ->where('messages.read', '=', '0');
                })
                ->where('messages.read', '=', '0')
                ->where('messages.senderId', '!=', Auth::id())
                ->distinct()
                ->count();

//            dd(DB::table('messages')
//                ->join('conversations', function($join){
//                    $join->on('conversations.id', '=', 'messages.conversationId')
//                        ->where('conversations.user1', '=', Auth::id())
//                        ->orWhere('conversations.user2', '=', Auth::id());
////                    ->where('messages.read', '=', '0');
//                })
//                ->where('messages.read', '=', '0')
//                ->where('messages.senderId', '!=', Auth::id())
//                ->distinct()
////                ->count('messages.id')
//                ->toSql(),
//
//                DB::table('messages')
//                    ->join('conversations', function($join){
//                        $join->on('conversations.id', '=', 'messages.conversationId')
//                            ->where('conversations.user1', '=', Auth::id())
//                            ->orWhere('conversations.user2', '=', Auth::id());
////                    ->where('messages.read', '=', '0');
//                    })
//                    ->where('messages.read', '=', '0')
//                    ->where('messages.senderId', '!=', Auth::id())
//                    ->distinct()
//                ->get(),
//
//                'Auth: ' .  Auth::id(),
//                'Unread: ' . $unread);

            $view->with('unreadMessages', $unread);
            $view->with('username', Auth::user()->username);
//            $view->with('time', $this->time->getTimeString());
//            $view->with('unixTime', $this->time->getTimeUnix());

            //TODO: Watched
        }

    }

}