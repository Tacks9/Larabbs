<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
     // 分类列表
    public function cacheTags()
    {
        if (is_null(cache('cacheTags'))) {
            // 缓存 分类列表categories数据  修改后，会自动清除缓存
            cache(['cacheTags' => $this->all()], 60*24);
        }
        return cache('cacheTags');
    }
}
