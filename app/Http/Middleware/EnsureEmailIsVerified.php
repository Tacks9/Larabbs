<?php

namespace App\Http\Middleware;

use Closure;

class EnsureEmailIsVerified
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
        /*
            三个判断：
                1. 如果用户已经登录
                2. 并且没有认证 Email
                3. 并且访问的不是 Email验证相关 URL或者退出的　URL
            那么就跳转去进行验证邮箱
        */
        if ($request->user() &&
            ! $request->user()->hasVerifiedEmail() &&
            ! $request->is('email/*', 'logout')) {

            return $request->expectsJson()
                        ? abort(403, 'Your email address is not verified.')
                        : redirect()->route('verification.notice');
        }
        return $next($request);
    }
}
