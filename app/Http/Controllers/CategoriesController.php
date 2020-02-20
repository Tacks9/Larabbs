<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;   // 帖子
use App\Models\Category;// 分类
use App\Models\User;    // 用户
use App\Models\Link;    // 链接
use App\Models\Carousel;// 轮播图

class CategoriesController extends Controller
{
    // 按照分类展示帖子
    public function show(Category $category, Request $request, Topic $topic, User $user, Link $link, Carousel $carousel)
    {
        // 读取分类 ID 关联的帖子，并按每 20 条分页
        // $topics = Topic::where('category_id', $category->id)->paginate(20);

        $topics = $topic->withOrder($request->order)
                        ->where('category_id', $category->id)->where('status',1)
                        ->with('user', 'category')
                        ->paginate(20);
        // 活跃用户列表
        $active_users = $user->getActiveUsers();
        // 资源链接
        $links = $link->getAllCached();
        // 轮播图
        $carousels = $carousel->getAllCached();
        // 传参变量到模板中
        return view('topics.index', compact('topics', 'category', 'active_users', 'links','carousels'));
    }
}
