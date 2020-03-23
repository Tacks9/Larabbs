<?php

namespace App\Observers;

use App\Models\Topic;
// use App\Handlers\SlugTranslateHandler;
use App\Jobs\TranslateSlug;

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

        //  // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
        // if ( ! $topic->slug) {
        //     // $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);
        //      // 推送任务到队列
        //     dispatch(new TranslateSlug($topic));
        // }
    }

    // 模型监控器的 saved() 方法对应 Eloquent 的 saved 事件，此事件发生在创建和编辑时、数据入库以后
    public function saved(Topic $topic)
    {
        // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
        if ( ! $topic->slug) {

            // 推送任务到队列
            dispatch(new TranslateSlug($topic));
        }
        // 计算每个分类下的 帖子数量
        $num = $topic->where('category_id', $topic->category_id)->count();
        \DB::table('categories')->where('id', $topic->category_id)->update(['post_count' => $num]);
    }

    // 话题被删除的时候 评论全部清空
    public function deleted(Topic $topic)
    {
        \DB::table('replies')->where('topic_id', $topic->id)->delete();
    }
}
