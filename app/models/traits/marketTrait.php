<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-04-12
 * Time: 20:59
 */

namespace market\models\traits;


use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use market\models\blockedMarket;
use market\models\scopes\marketBlockedMarketScope;
use market\models\scopes\marketBlockedSellerScope;
use market\models\scopes\withUserScope;

trait marketTrait
{
    public static function bootMarketTrait()
    {
        static::addGlobalScope(new marketBlockedMarketScope());
        static::addGlobalScope(new marketBlockedSellerScope());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public static function withBlockedMarkets()
    {
        return (new static)->newQueryWithoutScope(new marketBlockedMarketScope()) ;
    }

    public static function onlyBlockedMarkets()
    {
        //https://github.com/laravel/framework/issues/6425      2016-04-16
        return (new static)->newQueryWithoutScope(new marketBlockedMarketScope())->
            whereIn('id', function($query) {
                $query->from('blocked_markets')->where('userId', Auth::id())->select('marketId');
        });
    }

    public static function withMarketsFromBlockedSellers()
    {
        return (new static)->newQueryWithoutScope(new marketBlockedSellerScope()) ;
    }

    public static function onlyMarketsFromBlockedSellers()
    {
        //TODO: Implement
        return (new static)->newQueryWithoutScope(new marketBlockedSellerScope())->
        whereIn('createdByUser', function($query) {
            $query->from('blocked_users')->where('blockingUserId', Auth::id())->select('blockedUserId');
        });
    }
}
