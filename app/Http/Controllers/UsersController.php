<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

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
    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $data = $request->all();

        // 头像处理
        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 416);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }
        // 更新数据
        $user->update($data); // 表单请求验证update（FormRequest）来验证用户提交的数据
        return redirect()->route('users.show',$user->id)->with('success','个人资料更新成功');
    }
}
