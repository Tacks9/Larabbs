<?php

namespace App\Http\Middleware;

use Closure;

class AcceptHeader
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
        // 添加一个中间件，给所有的 API 路由手动设置一下
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
