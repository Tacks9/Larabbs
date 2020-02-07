<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    // 个人页面
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // 编辑页面
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // 编辑保存
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all()); // 表单请求验证update（FormRequest）来验证用户提交的数据
        return redirect()->route('users.show',$user->id)->with('success','个人资料更新成功');
    }
}
