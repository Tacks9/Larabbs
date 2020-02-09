<?php

namespace App\Http\Controllers;

use App\Models\Category;    // 分类
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use Auth;
use App\Handlers\ImageUploadHandler;

class TopicsController extends Controller
{
    public function __construct()
    {
        // 中间件 限制未登录用户发帖
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request, Topic $topic)
	{
		// $topics = Topic::paginate();
        // $topics = Topic::with('user', 'category')->paginate(30); // 预加载 缓存 关联关系
        // $request->order 获取url后面order的参数
        $topics = $topic->withOrder($request->order)
                        ->with('user', 'category')
                        ->paginate(20);
		return view('topics.index', compact('topics'));
	}

    public function show(Request $request, Topic $topic)
    {
        // URL 矫正
        // 如果话题的 Slug 字段不为空 并且话题 Slug 不等于请求的路由参数 Slug
        if ( ! empty($topic->slug) && $topic->slug != $request->slug) {
            // 301 永久重定向到正确的 URL 上
            return redirect($topic->link(), 301);
        }

        return view('topics.show', compact('topic')); // 『隐性路由模型绑定』 自动解析为 ID的帖子对象
    }

	public function create(Topic $topic)
	{
        $categories = Category::all();  // 显示分类
		return view('topics.create_and_edit', compact('topic', 'categories'));
	}

    // 存储
	public function store(TopicRequest $request, Topic $topic)
	{
		// $topic = Topic::create($request->all());
        // fill 方法会将传参的键值数组填充到模型的属性
        $topic->fill($request->all()); // 获取所有用户的请求数据数组
        $topic->user_id = Auth::id();  // 当前用户id

        $topic->save();                //  保存到数据库中

        // return redirect()->route('topics.show', $topic->id)->with('success', '帖子创建成功！');
        return redirect()->to($topic->link())->with('success', '成功创建话题！');
	}

	public function edit(Topic $topic)
	{
        // $this->authorize('update', $topic);
	   //  return view('topics.create_and_edit', compact('topic'));
        $this->authorize('update', $topic); // 授权策略的调用

        $categories = Category::all();      // 传入分类
        return view('topics.create_and_edit', compact('topic', 'categories'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic); // 授权策略的调用

		$topic->update($request->all());

		// return redirect()->route('topics.show', $topic->id)->with('message', '更新成功！');
        return redirect()->to($topic->link())->with('success', '更新成功！');

	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('message', '成功删除！');
	}

    // 上传图片
    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的
        $data = [
            'success'   => false,
            'msg'       => '上传失败!',
            'file_path' => ''
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->save($file, 'topics', \Auth::id(), 1024);
            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "上传成功!";
                $data['success']   = true;
            }
        }
        return $data;
    }
}
