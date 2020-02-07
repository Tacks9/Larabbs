<?php

namespace App\Handlers;

use Illuminate\Support\Str;

/**
 *
 * 图片上传类
 */
class ImageUploadHandler
{

    // 允许的后缀名
    protected $allowed_ext = ['png','jpg','gif','jpeg'];

    public function save($file, $folder, $file_prefix)
    {
        // 拼接存储图片的文件夹 目录 按照日期可以方便查找
        $folder_name = "uploads/images/$folder/" . date(
            "Ym/d", time());

        // 文件具体存储的物理路径 public_path()获取具体路径
        $upload_path = public_path() . '/' . $folder_name;

        // 获取文件的后缀名 如果不存在默认的粘贴过来的存为png
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';
        // 拼接文件名  加上前缀
        // 类似 1_1493521050_7BVc9v9ujP.png id_时间戳_随机字符.后缀
        $filename = $file_prefix . '_' . time() . '_' . Str::random(10) . '.' . $extension;

        // 如果上传的不是图片 返回失败
        if (! in_array($extension, $this->allowed_ext))
        {
            return false;
        }

        // 移动目标路径
        $file->move($upload_path,$filename);

        return [
            'path' => config('app.url')."/$folder_name/$filename"
        ];
    }
}
