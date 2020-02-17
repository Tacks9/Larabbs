<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // 不需要维护  created_at 和 updated_at 这两个字段
    public $timestamps = false;

    protected $fillable = [
        'name', 'description',
    ];

    // 分类列表
    public function categories()
    {
        if (is_null(cache('categories'))) {
            // 缓存 分类列表categories数据  修改后，会自动清除缓存
            cache(['categories' => $this->all()], 60*24);
        }
        return cache('categories');
    }
}
