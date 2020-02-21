<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{

    public function __construct()
    {
        // 调用中间件  除了show 其他都需要登录才可以访问 首选 except 方法
        $this->middleware('auth', ['except' => ['show']]);
    }

    // 个人页面
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // 编辑页面
    public function edit(User $user)
    {
        $this->authorize('update', $user); // 当前用户登录的
        return view('users.edit', compact('user'));
    }

    // 编辑保存
    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $this->authorize('update', $user); // 当前用户登录的

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


    // 关注列表
    public function followings(User $user)
    {
        $users = $user->followings()->paginate(30);
        $title = $user->name . '关注的人';
        return view('users.show_follow', compact('user','users', 'title'));
    }

    // 粉丝列表
    public function followers(User $user)
    {
        $users = $user->followers()->paginate(30);
        $title = $user->name . '的粉丝';
        return view('users.show_follow', compact('user','users', 'title'));
    }
}
