<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IPAuthMiddleware
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
       
        $isPrd = !$this->isDebug();
        $isDenied = !$this->whetherThisIpAccepted();
        if ($isPrd && $isDenied) {
            return abort(403);
        }
    
        return $next($request);
    }

    protected function isDebug()
    {
        if (env('APP_DEBUG') !==  true) {
            return false;
        }
        return true;
    }

    protected function whetherThisIpAccepted()
    {
        $ipArr = explode(',', env("APP_IP", ""));
        \Request::setTrustedProxies([\Request::ip()],Request::HEADER_X_FORWARDED_ALL);
        if ($ipArr && !in_array(\Request::ip(), $ipArr)) {
            dd(in_array(\Request::ip(), $ipArr));
            return false;
        }
        return true;
    }
}
