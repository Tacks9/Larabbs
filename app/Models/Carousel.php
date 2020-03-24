<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Carousel extends Model
{
    //
    protected $fillable = ['title', 'image', 'link', 'status'];

    public $cache_key = 'larabbs_carousels';
    protected $cache_expire_in_seconds = 1440 * 60;

    // 获取缓存数据
    public function getAllCached()
    {
        // 尝试从缓存中取出 cache_key 对应的数据。如果能取到，便直接返回数据。
        // 否则运行匿名函数中的代码来取出  carousels 表中所有的数据，返回的同时做了缓存。
        return Cache::remember($this->cache_key, $this->cache_expire_in_seconds,
            function(){
                return $this->all();
        });
    }

    // 自动补全轮播图
    public function setImageAttribute($path)
    {
        // 如果不是 `http` 子串开头，那就是从后台上传的，需要补全 URL
        if ( ! \Str::startsWith($path, 'http')) {

            // 拼接完整的 URL
            $path = config('app.url') . "/uploads/images/carousels/$path";
        }

        $this->attributes['image'] = $path;
    }
}
