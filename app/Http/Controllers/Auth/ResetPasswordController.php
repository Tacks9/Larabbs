<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

     public function __construct()
    {
        $this->middleware('guest');
    }

    // 重写 ResetsPasswords sendResetResponse()方法
    protected function sendResetResponse(Request $request, $response)
    {
        // 添加一条提示信息
        session()->flash('success', '密码更新成功，您已成功登录！');
        return redirect($this->redirectPath());
    }
}
