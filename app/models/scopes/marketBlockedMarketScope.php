<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-04-12
 * Time: 21:01
 */

namespace market\models\scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ScopeInterface;
use Illuminate\Support\Facades\DB;
use Sofa\GlobalScope\GlobalScope;

class marketBlockedMarketScope /*extends GlobalScope*/ extends baseScope implements ScopeInterface
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
        $builder->has('marketBlockedByUser', '<', 1);
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
        $valueQuery = "(select count(*) from `".$tablePrefix."blocked_markets` where `".$tablePrefix."blocked_markets`.`marketId` = `".$tablePrefix."markets`.`id` and `userId` = ?)";

        $bindingKey = 0;

        foreach($query->wheres as $key => $value)
        {
            if($value['type'] == 'Basic' && $value['column'] == $valueQuery)
            {
                $this->removeWhere($query, $key);

                // Here SoftDeletingScope simply removes the where
                // but since we use Basic where (not Null type)
                // we need to get rid of the binding as well
                $this->removeBinding($query, $bindingKey);
            }

            // Check if where is either NULL or NOT NULL type,
            // if that's the case, don't increment the key
            // since there is no binding for these types
            if ( ! in_array($value['type'], ['Null', 'NotNull'])) $bindingKey++;
        }
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
//        dd($where, $model);
//        // TODO: Implement isScopeConstraint() method.
//    }
}