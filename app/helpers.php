<?php

// 当前请求的路由名称转换为 CSS 类名称
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}


//  导航栏选中状态
function category_nav_active($category_id)
{
    // active_class($condition, $activeClass = 'active', $inactiveClass = '') 函数
    //  如果 $condition 不为 False 即会返回字符串 `active`
    /*
        安装扩展 summerblue/laravel-active:6.*

        if_route () - 判断当前对应的路由是否是指定的路由
        if_route_param () - 判断当前的 url 有无指定的路由参数
    */
    return active_class((if_route('categories.show') && if_route_param('category', $category_id)));
}


// 根据帖子自动生成摘要
function make_excerpt($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return Str::limit($excerpt, $length);
}
