<?php

namespace App\Observers;

use App\Models\Carousel;
use Cache;

class CarouselObserver
{
    // 保存的时候清空对应缓存
    public function saved(Carousel $carousel)
    {
        //
        Cache::forget($carousel->cache_key);
    }

}
