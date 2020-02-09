<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;   // 帖子
use App\Models\Category;// 分类

class CategoriesController extends Controller
{
    // 按照分类展示帖子
    public function show(Category $category, Request $request, Topic $topic)
    {
        // 读取分类 ID 关联的帖子，并按每 20 条分页
        // $topics = Topic::where('category_id', $category->id)->paginate(20);

        $topics = $topic->withOrder($request->order)
                        ->where('category_id', $category->id)
                        ->with('user', 'category')
                        ->paginate(20);
        // 传参变量话题和分类到模板中
        return view('topics.index', compact('topics', 'category'));
    }
}
