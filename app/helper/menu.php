<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-09-27
 * Time: 23:07
 */

namespace market\helper;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use market\Conversation;
use market\Message;

class menu {

    public function __construct()
    {

    }

    public function getTime()
    {
        return time();
    }

    public function compose(View $view)
    {
//        $userId = Auth::id();
//        if($userId != null)
//        {
//
//            $conversations = Conversation::where('user1', $userId)
//                ->orWhere('user2', $userId)
//                ->with('messages')
//                ->get();
//
//           $db = DB::table('conversations')->join('messages', function($join){
//                $join->on('conversations.id', '=', 'messages.conversationId')
//                    ->where('messages.read', '=', '0');
//               //TODO: Where unread
//           })->count();
//
//            $db2 = DB::table('conversations')->join('messages', function($join){
//                $join->on('conversations.id', '=', 'messages.conversationId')
//                    ->where('messages.read', '=', '0');
//               //TODO: Where unread
//           })->select('read')->get();
//
//
//            dd('menu', $userId, $conversations, $db, $db2);
//
//        }
//
//        dd('menu', $userId);

        $view->with('time', date('H:i:s', time() + 60*60*2));

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

            $view->with('unreadMessages', $unread);
            $view->with('username', Auth::user()->username);

//            dd($unread, Conversation::all()->count(), Message::all()->count());
        }

    }

}