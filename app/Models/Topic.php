<?php

namespace App\Models;
use Auth;

class Topic extends Model
{
    protected $fillable = [
        'title', 'body', 'category_id', 'excerpt', 'slug'
    ];

    // 一个帖子 属于一个分类
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 一个帖子 属于一个用户
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 一个帖子 可以有多个评论
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    // 【多对多】 一个帖子可以有多个标签
    public function tags_topics()
    {
        return $this->belongsToMany(Tag::class, 'tags_topics', 'topic_id', 'tag_id');
    }

    //
    public function favorited()
    {
        return (bool) Favorite::where('user_id', Auth::id())
                            ->where('topic_id', $this->id)
                            ->first();
    }

/*
    对应 Eloquent 模型方法前加上一个 scope 前缀
    作用域总是返回 查询构建器

    在进行方法调用时不需要加上 scope 前缀。

    如以上代码中的 recent() 和 recentReplied()。
*/
    // 排序
    public function scopeWithOrder($query, $order)
    {
        // 不同的排序，使用不同的数据读取逻辑
        switch ($order) {
            // 最近发布
            case 'recent':
                $query->recent();
                break;
            // 零评论
            case 'zero':
                $query->zero();
                break;
             // 热榜
            case 'hot':
                $query->hot();
                break;
            // 默认最近回复
            default:
                $query->recentReplied();
                break;
        }
    }

    // 按照最近回复的
    public function scopeRecentReplied($query)
    {
        // 当话题有新回复时，我们将编写逻辑来更新话题模型的 reply_count 属性，
        // 此时会自动触发框架对数据模型 updated_at 时间戳的更新
        return $query->orderBy('top', 'desc')->orderBy('updated_at', 'desc');
    }

    // 按照最近创建的时间
    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('top', 'desc')->orderBy('created_at', 'desc');
    }

    // 按照零评论
    public function scopeZero($query)
    {
        // 按照创建时间排序
        return $query->where('reply_count', '0')->orderBy('top', 'desc')->orderBy('created_at', 'desc');
    }

    // 阅读数 热榜
    public function scopeHot($query)
    {
        // 按照创建时间排序
        return $query->orderBy('top', 'desc')->orderBy('view_count', 'desc')->orderBy('updated_at','desc');
    }

    // 链接生成方式
    public function link($params = [])
    {
        // 参数作用 可以在视图中直达评论的锚点 $reply->topic->link(['#reply' . $reply->id])
        return route('topics.show', array_merge([$this->id, $this->slug], $params));
    }

    // 更新消息数  抽象化出来
    public function updateReplyCount()
    {
        $this->reply_count = $this->replies->count();
        $this->save();
    }
}
