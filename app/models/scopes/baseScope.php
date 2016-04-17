<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-04-14
 * Time: 00:36
 */

namespace market\models\scopes;


class baseScope
{
    //2016-04-16
    //https://softonsofa.com/laravel-5-eloquent-global-scope-how-to/

    /**
     * Remove scope constraint from the query.
     *
     * @param  \Illuminate\Database\Query\Builder $builder
     * @param  int $key
     * @return void
     */
    protected function removeWhere($query, $key)
    {
        unset($query->wheres[$key]);

        $query->wheres = array_values($query->wheres);
    }

    /**
     * Remove scope constraint from the query.
     *
     * @param  \Illuminate\Database\Query\Builder $builder
     * @param  int $key
     * @return void
     */
    protected function removeBinding($query, $key)
    {
//        dd($query->getBindings(), $query, $key);

        $bindings = $query->getRawBindings()['where'];

        unset($bindings[$key]);

        $query->setBindings($bindings);

//        dd($query->getBindings());
    }

    // -------------------------------------------------------

    protected function removeWhereAndBinding($query, $key, $bindingKey)
    {
        $this->removeWhere($query, $key);

        // Here SoftDeletingScope simply removes the where
        // but since we use Basic where (not Null type)
        // we need to get rid of the binding as well
        $this->removeBinding($query, $bindingKey);
    }

    protected function iterateBindningKey($value, &$bindingKey)
    {
        // Check if where is either NULL or NOT NULL type,
        // if that's the case, don't increment the key
        // since there is no binding for these types
        if ( ! in_array($value['type'], ['Null', 'NotNull'])) $bindingKey++;
    }
}