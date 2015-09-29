<?php namespace market\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class MyVerifyCsrfToken extends BaseVerifier {

    protected $openRoutes = [
        'dev/*',
        'phpBB/*'
    ];

    /**openRoutes
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        $results = [];
//        return $next($request);
        foreach($this->openRoutes as $route) {

//            array_push($results, [$route, $request->is($route), $next]);
//            dd($route, $request->is($route), $next);

            if ($request->is($route)) {
                return $next($request);
            }
        }

//        dd($results);

        return parent::handle($request, $next);
    }

}