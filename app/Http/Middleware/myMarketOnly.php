<?php namespace market\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use market\models\Market;

class myMarketOnly
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        preg_match('/[0-9]\d*/', $request->path(), $match);
        if (isset($match[0]) && is_numeric($match[0]))
        {
            $market = Market::find($match[0]);
            if ($market)
            {
                if($market->createdByUser != Auth::id())
                {
                    abort(403);
                }
            }
            else
            {
                abort(404);
            }
        }
        else
        {
            abort(404);
        }

        return $next($request);
    }

}
