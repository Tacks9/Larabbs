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

    // 【多对多】 一个用户可以关注多个人， 同样关注的人拥有多个粉丝
    // 粉丝关系列表
    public function followers()
    {
        // Laravel 中会默认将两个关联模型的名称进行合并，并按照字母排序
        // 自定义生成的名称，把关联表名改为 followers
        // 传递额外参数至 belongsToMany 方法来自定义数据表里的字段名称
        // 第三个参数 user_id 是定义在关联中的模型外键名
        // 第四个参数 follower_id 则是要合并的模型外键名
        return $this->belongsToMany(User::Class,'followers', 'user_id', 'follower_id');
    }

    // 用户关注人列表
    public function followings()
    {
        return $this->belongsToMany(User::Class, 'followers', 'follower_id', 'user_id');
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


    // 关注用户
    public function follow($user_ids)
    {
        if( !is_array($user_ids)) {
            $user_ids = compact('user_ids'); // 转成数组
        }
        // 关注一个新用户的时候，仍然要保持之前已关注用户的关注关系
        // 第二个参数 false 是否要移除其它不包含在关联的 id 数组
        // 这样下次 id 为同样的数据并不会被重复创建
        $this->followings()->sync($user_ids, false);
    }

    // 取消关注
    public function unfollow($user_ids)
    {
        if ( ! is_array($user_ids)) {
            $user_ids = compact('user_ids'); // 转成数组
        }
        // detach 来对用户进行取消关注的操作
        $this->followings()->detach($user_ids);
    }

    // 判断当前登录的用户 A 是否关注了用户 B
    public function isFollowing($user_id)
    {
        // 判断用户 B 是否包含在用户 A 的关注人列表上即可
       return $this->followings->contains($user_id);
    }

     // 关注流
    public function feed()
    {
        $user_ids = $this->followings->pluck('id')->toArray();
        array_push($user_ids, $this->id);
        return Topic::whereIn('user_id', $user_ids)
                              ->with('user', 'category')
                              ->orderBy('created_at', 'desc');
    }
}
