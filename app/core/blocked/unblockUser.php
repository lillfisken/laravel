<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-11-21
 * Time: 19:00
 */

namespace market\core\blocked;


use market\models\blockedUser;

class unblockUser
{
    public function unblock($blockerUserId, $blockedUserId)
    {
        $blocked = blockedUser::where('blockingUserId', $blockerUserId)
            ->where('blockedUserId', $blockedUserId)
            ->first();

        if($blocked)
        {
            return $blocked->delete();
//            dd(
//                'Result: ' . $blocked->delete(),
//                'BlockerUserId: ' . $blockerUserId,
//                'BlockingUserId: ' . $blockedUserId,
//                'Blocked: ' . $blocked
//            );
        }

        abort(404);
    }
}