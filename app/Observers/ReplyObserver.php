<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;

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
        $reply->topic->updateReplyCount();

        // 通知话题作者有新的评论
        $reply->topic->user->notify(new TopicReplied($reply));
        // 同时更新当前最新评论的用户
        /*
        \DB::table('topics')
              ->where('id', $reply->topic->id)
              ->update(['last_reply_user_id' => \Auth::id()]);
        */
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


    public function deleted(Reply $reply)
    {
        // 当回复被删除后，评论数已变更，话题的 reply_count 也需要更新
        $reply->topic->updateReplyCount();
    }
}
