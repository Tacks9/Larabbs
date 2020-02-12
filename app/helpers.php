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



function model_admin_link($title, $model)
{
    return model_link($title, $model, 'admin');
}

function model_link($title, $model, $prefix = '')
{
    // 获取数据模型的复数蛇形命名
    $model_name = model_plural_name($model);

    // 初始化前缀
    $prefix = $prefix ? "/$prefix/" : '/';

    // 使用站点 URL 拼接全量 URL
    $url = config('app.url') . $prefix . $model_name . '/' . $model->id;

    // 拼接 HTML A 标签，并返回
    return '<a href="' . $url . '" target="_blank">' . $title . '</a>';
}

function model_plural_name($model)
{
    // 从实体中获取完整类名，例如：App\Models\User
    $full_class_name = get_class($model);

    // 获取基础类名，例如：传参 `App\Models\User` 会得到 `User`
    $class_name = class_basename($full_class_name);

    // 蛇形命名，例如：传参 `User`  会得到 `user`, `FooBar` 会得到 `foo_bar`
    $snake_case_name = Str::snake($class_name);

    // 获取子串的复数形式，例如：传参 `user` 会得到 `users`
    return Str::plural($snake_case_name);
}
