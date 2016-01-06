<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-09-28
 * Time: 00:52
 */

namespace market\Providers;


use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layout.menu', 'market\ViewComposers\menu');
        View::composer('*', 'market\ViewComposers\all');
//        // Using class based composers...
//        View::composer('profile', 'App\Http\ViewComposers\ProfileComposer');
//
//        // Using Closure based composers...
//        View::composer('dashboard', function($view)
//        {
//
//        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // TODO: Implement register() method.
    }
}