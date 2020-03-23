<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class FollowersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 关注
    public function store(User $user)
    {
        // 用户不能对自己进行关注和取消关注
        $this->authorize('follow', $user);

        // 用户是否没有关注
        if ( ! Auth::user()->isFollowing($user->id)) {
            Auth::user()->follow($user->id);
        }

        // return redirect()->route('users.show', $user->id);
        return back()->with('user', $user->id); // 重定向上一页 并且携带数据
    }

    // 取消关注
    public function destroy(User $user)
    {
        $this->authorize('follow', $user);

        // 用户是否已经关注
        if (Auth::user()->isFollowing($user->id)) {
            Auth::user()->unfollow($user->id);
        }
        // return redirect()->route('users.show', $user->id);
        return back()->with('user', $user->id);
    }
}
