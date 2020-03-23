<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
// 通知类接口
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Reply;

// 队列系统ShouldQueue
class TopicReplied extends Notification implements ShouldQueue
{
    //   Queueable trait 把通知加入队列
    use Queueable;

    public $reply;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reply $reply)
    {
        // 注入回复实体，方便 toDatabase 方法中的使用
        $this->reply = $reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    // 每个通知类都有个 via() 方法，它决定了通知在哪个频道上发送
    public function via($notifiable)
    {
         // 开启通知的频道
        return ['database', 'mail'];
    }

    // 数据库方式
    public function toDatabase($notifiable)
    {
        $topic = $this->reply->topic;
        $link =  $topic->link(['#reply' . $this->reply->id]);

        // 存入数据库里的数据
        return [
            'reply_id' => $this->reply->id,
            'reply_content' => $this->reply->content,
            'user_id' => $this->reply->user->id,
            'user_name' => $this->reply->user->name,
            'user_avatar' => $this->reply->user->avatar,
            'topic_link' => $link,
            'topic_id' => $topic->id,
            'topic_title' => $topic->title,
        ];
    }

    // 邮件方式
    public function toMail($notifiable)
    {
        $url = $this->reply->topic->link(['#reply' . $this->reply->id]);

        return (new MailMessage)
                    ->line('你的话题有新回复！')
                    ->action('查看回复', $url);
    }
}
