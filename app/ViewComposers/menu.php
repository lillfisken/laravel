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
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use market\Conversation;
use market\core\time;
use market\Message;
use market\models\eventUser;
use market\models\watchedEvent;

class menu {

    protected $time;

    public function __construct(time $time)
    {
        $this->time = $time;
    }

    public function compose(View $view)
    {
        if(Auth::check())
        {
            $userId = Auth::id();

//            Log::debug('Viewcomposer->menu->countUnreadMessage');
            $view->with('unreadMessagesCount', $this->countUnreadMessages($userId));
//            Log::debug('Viewcomposer->menu->Auth::user');
            $view->with('username', Auth::user()->username);
//            Log::debug('Viewcomposer->menu->countUnreadEventsForWatched');
            $view->with('watchedCount', $this->countUnreadEventsForWatched($userId));

//            $view->with('time', $this->time->getTimeString());
//            $view->with('unixTime', $this->time->getTimeUnix());

            //TODO: Watched
        }

    }

    protected function countUnreadMessages($userId)
    {
        $unread = DB::table('conversations')
            ->join('messages', function($join) use ($userId) {
                $join
                    ->on('conversations.id', '=', 'messages.conversationId')
                    ->where('messages.read', '=', '0')
                    ->where('messages.senderId', '!=', $userId);
            })

            ->where('conversations.user1', '=', $userId)
            ->orWhere('conversations.user2', '=', $userId)
            ->count();

        return $unread;
    }

    protected function countUnreadEventsForWatched($userId)
    {
        $unreadCount = eventUser::where('userId', Auth::id())
            ->where('read', null)
            ->count();

        return $unreadCount;
    }

}