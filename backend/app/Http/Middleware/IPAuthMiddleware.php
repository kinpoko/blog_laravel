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
        $isPrd = $this->isDebug();
        if(!$isPrd){
        $isDenied = !$this->whetherThisIpAccepted();
        $isPrd = !$this->isDebug();
        if ($isPrd && $isDenied) {
            return Response::create(view("errors.403"), 403);
        }
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
        \Request::setTrustedProxies([\Request::ip()]);

        if ($ipArr && !in_array(\Request::ip(), $ipArr)) {
            return false;
        }
        return true;
    }
}
