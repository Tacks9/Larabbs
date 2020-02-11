<?php

namespace App\Observers;

use App\Models\Reply;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{

    public function created(Reply $reply)
    {
        // 模型监控器 监控 created 事件，当 Elequont 模型数据成功创建时，created 方法将会被调用

        // 评论加1
        // $reply->topic->increment('reply_count', 1);

        // 创建成功后计算本话题下评论总数，然后在对其 reply_count 字段进行赋值
        $reply->topic->reply_count = $reply->topic->replies->count();
        $reply->topic->save();
    }

    public function creating(Reply $reply)
    {
        // 处理回复内容 HTMLPurifier 对 content 字段进行净化处理
        $reply->content = clean($reply->content, 'user_topic_body');
    }

    public function updating(Reply $reply)
    {
        //
    }
}
