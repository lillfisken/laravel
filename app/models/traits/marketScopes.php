<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-04-21
 * Time: 22:45
 */

namespace market\models\traits;


use Illuminate\Support\Facades\Auth;

trait marketScopes
{
    public function scopeWithoutMarketsFromBlockedSellers($query)
    {
//        dd(Auth::id());
        return $query->whereDoesntHave('blockedByUsers', function($query) {
            return $query->where('blockingUserId', Auth::id());
        });
    }

    public function scopeOnlyMarketsFromBlockedSellers($query)
    {
        return $query->whereHas('blockedByUsers', function($query) {
            return $query->where('blockingUserId', Auth::id());
        });
    }

    public function scopeWithoutBlockedMarketByUser($query)
    {
        return $query->doesntHave('marketBlockedByUser');
    }

    public function scopeOnlyBlockedMarketByUser($query)
    {
        return $query->has('marketBlockedByUser');
    }
}