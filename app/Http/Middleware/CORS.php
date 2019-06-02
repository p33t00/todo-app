<?php

namespace App\Http\Middleware;

use Closure;

class CORS
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $response = $next($request);
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
//            ->header('Access-Control-Allow-Headers', 'Content-type')
            ->header('Access-Control-Allow-Headers', 'Accept, Content-type, Authorization, X-Requested-With, X-XSRF-TOKEN')
            ;
    }
}


//        ->header('Access-Control-Allow-Headers ', 'Origin, Authorization, X-Requested-With, Content-Type, Accept')
//        ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS')
//        ->header('Access-Control-Allow-Origin', '*')
//        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0')