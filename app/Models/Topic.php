<?php

namespace App\Models;

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
            case 'recent':
                $query->recent();
                break;

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
        return $query->orderBy('updated_at', 'desc');
    }

    // 按照最近创建的时间
    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }
}
