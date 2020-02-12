<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;

use Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmailContract
{
    // 加载使用 MustVerifyEmail trait.
    // PHP 的 trait 功能，User 模型在 use 以后，即可使用以上四个方法
    use MustVerifyEmailTrait;

    use Notifiable {
        notify as protected laravelNotify;
    }

    // 获取到扩展包提供的所有权限和角色的操作方法
    use HasRoles;

    // 缓存活跃用户
    use Traits\ActiveUserHelper;

    // 最近登录用户
    use Traits\LastActivedAtHelper;

    // 信息通知
    public function notify($instance)
    {
        // 如果要通知的人是当前用户，就不必通知了！
        if ($this->id == Auth::id()) {
            return;
        }

        // 只有数据库类型通知才需提醒，直接发送 Email 或者其他的都 Pass
        if (method_exists($instance, 'toDatabase')) {
            $this->increment('notification_count');
        }

        $this->laravelNotify($instance);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // 允许修改的属性
    protected $fillable = [
        'name', 'email', 'password', 'introduction', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //   【一对多】
    //   一个用户可以发布多个帖子
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    // 一个用户可以拥有多条评论
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    // 当前用户是否等于编辑的id
    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }

    // 清除未读消息标示
    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }


    // 解决后台密码修改不能登录的原因
    public function setPasswordAttribute($value)
    {
           // 如果值的长度等于 60，即认为是已经做过加密的情况
           if (strlen($value) != 60) {

               // 不等于 60，做密码加密处理
               $value = bcrypt($value);
           }

           $this->attributes['password'] = $value;
    }

    // 解决后台头像问题
    public function setAvatarAttribute($path)
    {
         // 如果不是 `http` 子串开头，那就是从后台上传的，需要补全 URL
         if ( ! \Str::startsWith($path, 'http')) {

             // 拼接完整的 URL
             $path = config('app.url') . "/uploads/images/avatars/$path";
         }

         $this->attributes['avatar'] = $path;
    }
}
