<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-11-21
 * Time: 19:00
 */

namespace market\core\blocked;


use market\models\blockedUser;

class blockUser
{
    public function block($userBlockingId, $userBlockedId)
    {
//        dd($userBlockingId, $userBlockedId);
        if($userBlockingId > 0 && $userBlockedId > 0)
        {
            $blocked = new blockedUser([
                'blockingUserId' => $userBlockingId,
                'blockedUserId' => $userBlockedId
            ]);

            return $blocked->save();
        }

        abort(404);
    }
}