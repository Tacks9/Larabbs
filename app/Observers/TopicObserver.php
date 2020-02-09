<?php

namespace App\Observers;

use App\Models\Topic;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    // 在 Topic 模型保存时触发的 saving 事件中
    public function saving(Topic $topic)
    {
        // 入库前进行过滤
        $topic->body = clean($topic->body, 'user_topic_body');
        // 对 excerpt 字段进行赋值
        $topic->excerpt = make_excerpt($topic->body);
    }
}
