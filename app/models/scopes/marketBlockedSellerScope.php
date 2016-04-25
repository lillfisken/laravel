<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-04-13
 * Time: 23:26
 */

namespace market\models\scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ScopeInterface;
use Illuminate\Support\Facades\DB;
use Sofa\GlobalScope\GlobalScope;

class marketBlockedSellerScope /*extends GlobalScope*/ extends baseScope implements ScopeInterface
{

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {

        $builder->has('marketUserBlockedByUser', '<', 1);
    }


    /**
     * Remove the scope from the given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     *
     * @return void
     */
    public function remove(Builder $builder, Model $model)
    {
        $query = $builder->getQuery();

        $tablePrefix = DB::getTablePrefix();
        $valueQuery = "(select count(*) from `".$tablePrefix."blocked_users` where `".$tablePrefix."blocked_users`.`blockedUserId` = `".$tablePrefix."markets`.`createdByUser` and `blockingUserId` = ?)";

        $bindingKey = 0;

        foreach($query->wheres as $key => $value)
        {
            if($value['type'] == 'Basic' && $value['column'] == $valueQuery)
            {
                $this->removeWhereAndBinding($query, $key, $bindingKey);
            }

            $this->iterateBindningKey($value, $bindingKey);
        }

        dd($query);
//        return $query;
    }


//    /**
//     * Determine whether where clause is the contraint applied by this scope.
//     *
//     * @param  array $where Single element from the Query\Builder::$wheres array.
//     * @param  \Illuminate\Database\Eloquent\Model $model
//     * @return boolean
//     */
//    public function isScopeConstraint(array $where, Model $model)
//    {
//        // TODO: Implement isScopeConstraint() method.
//    }
}