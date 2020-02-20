<?php

use App\Models\Carousel;

return [
    'title'   => '轮播图',
    'single'  => '轮播图设置',

    'model'   => Carousel::class,

    // 访问权限判断
    'permission'=> function()
    {
        // 只允许站长管理资源推荐链接
        return Auth::user()->hasRole('Founder');
    },

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'title' => [
            'title'    => '名称',
            'sortable' => false,
            'output' => function ($name, $model) {
                return '<a href="'.$model->link.'" target=_blank>'.$name.'</a>';
            },
        ],
        'image' => [
            'title'    => '图片',
            'sortable' => false,
             // 默认情况下会直接输出数据，你也可以使用 output 选项来定制输出内容
            'output' => function ($image, $model) {
                return empty($image) ? 'N/A' : '<img src="'.$image.'" width="60">';
            },
        ],
        'link' => [
            'title'    => '链接',
            'sortable' => false,
        ],
        'status' => [
            'title'    => '状态',
            'sortable' => false,
        ],
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'title' => [
            'title'    => '名称',
        ],
        'image' => [
            'title'    => '图片',
             // 设置表单条目的类型，默认的 type 是 input
            'type' => 'image',

            // 图片上传必须设置图片存放路径
            'location' => public_path() . '/uploads/images/carousels/',
        ],
        'link' => [
            'title'    => '链接',
        ],
        'status' => [
            'title'    => '状态',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => '图片 ID',
        ],
        'title' => [
            'title' => '名称',
        ],
        'link' => [
            'title'    => '链接',
        ],
        'status' => [
            'title'    => '状态',
        ],
    ],
];
