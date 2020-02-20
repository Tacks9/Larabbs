<?php

namespace App\Http\Controllers;

use App\Models\Category;    // 分类
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use Auth;
use App\Handlers\ImageUploadHandler;
use App\Models\User;
use App\Models\Link;
use App\Models\Carousel;

class TopicsController extends Controller
{
    public function __construct()
    {
        // 中间件 限制未登录用户发帖 搜索
        $this->middleware('auth', ['except' => ['index', 'show', 'search']]);
    }

	public function index(Request $request, Topic $topic, User $user, Link $link, Carousel $carousel)
	{
		// $topics = Topic::paginate();
        // $topics = Topic::with('user', 'category')->paginate(30); // 预加载 缓存 关联关系
        // $request->order 获取url后面order的参数
        $topics = $topic->withOrder($request->order)->where('status',1)
                        ->with('user', 'category')
                        ->paginate(20);

        $active_users = $user->getActiveUsers();
        $links = $link->getAllCached();
        $carousels = $carousel->getAllCached();

        // 传参变量到模板中
        return view('topics.index', compact('topics', 'category', 'active_users', 'links','carousels'));
	}

    public function show(Request $request, Topic $topic)
    {

        $is_status = 1; // 默认是可以看到的
        // 当前帖子被撤销
        if($topic->status != 1 ) {
            // 并且当前用户 发帖人 或者是管理员 可以查看
            if(Auth::id() == $topic->user_id || config('administrator.permission')() ) {
                $is_status = 0;
            }else{
                return redirect()->route('topics.index')->with('warning','访问帖子出错！');
            }
        }
        // URL 矫正
        // 如果话题的 Slug 字段不为空 并且话题 Slug 不等于请求的路由参数 Slug
        if ( ! empty($topic->slug) && $topic->slug != $request->slug) {
            session()->reflash(); // 通过reflash使得重定向后的页面能收到这个值
            // 301 永久重定向到正确的 URL 上
            return redirect($topic->link(), 301);
        }
        // 文章阅读数+1
        // $request->server()可以获取到所有 $_SERVER 信息
        if(!isset($request->server()['HTTP_CACHE_CONTROL'])) {
            $topic->increment('view_count');
        }

        return view('topics.show', compact('topic','is_status')); // 『隐性路由模型绑定』 自动解析为 ID的帖子对象
    }

	public function create(Topic $topic,Category $category)
	{
        $categories = $category->getSwitchCategory();  // 显示分类
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

	public function edit(Topic $topic,Category $category)
	{
        // $this->authorize('update', $topic);
	   //  return view('topics.create_and_edit', compact('topic'));
        $this->authorize('update', $topic); // 授权策略的调用

        // $categories = Category::all();      // 传入分类
        $categories = $category->getSwitchCategory();  // 显示分类
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

    // 搜索
    public function search(Request $request,Topic $topic, User $user, Link $link, Carousel $carousel)
    {

        $keyword=$request->input('keyword');

        $count  =$topic->where('title',$keyword)->orWhere('title','like','%'.$keyword.'%')->with('user', 'category')->count();
        $topics = $topic->where('title',$keyword)->orWhere('title','like','%'.$keyword.'%')->with('user', 'category')->paginate(20);


        $active_users = $user->getActiveUsers();
        $links = $link->getAllCached();
        $carousels = $carousel->getAllCached();

        return view('topics.search', compact('topics','keyword','count', 'active_users', 'links','carousels'));
    }


}
