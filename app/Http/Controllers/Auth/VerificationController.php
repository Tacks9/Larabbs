<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */
    // 一般都使用 PHP 的 Trait 机制来将提前设定好的功能注入到控制器
    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // 三个构建中间件 简称
        // 设定了所有的控制器动作都需要登录后才能访问。
        $this->middleware('auth');
        // 设定了 只有 verify 动作使用 signed 中间件进行认证
        $this->middleware('signed')->only('verify');
        // 对 verify 和 resend 动作做了频率限制
        // throttle 中间件是框架提供的访问频率限制功能 这两个动作访问频率是 1 分钟内不能超过 6 次
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
