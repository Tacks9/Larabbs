<?php

namespace App\Handlers;

use Illuminate\Support\Str;

use Image;
/**
 *
 * 图片上传类
 */
class ImageUploadHandler
{

    // 允许的后缀名
    protected $allowed_ext = ['png','jpg','gif','jpeg'];

    /**
    * 保存图片save()
    * @param string $file
    * @param string $file_prefix
    * @param bool $max_width
    *
    * @return bool
    */
    public function save($file, $folder, $file_prefix, $max_width = false)
    {
        // 拼接存储图片的文件夹 目录 按照日期可以方便查找
        $folder_name = "uploads/images/$folder/" . date("Ym/d", time());

        // 文件具体存储的物理路径 public_path()获取具体路径
        $upload_path = public_path() . '/' . $folder_name;

        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
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


        // 如果限制了图片宽度，就进行裁剪
        if ($max_width && $extension != 'gif') {
            // 此类中封装的函数，用于裁剪图片
            $this->reduceSize($upload_path . '/' . $filename, $max_width);
        }

        return [
            'path' => config('app.url')."/$folder_name/$filename"
        ];
    }

    /**
     * 剪切图片
     *
     * @param  string $file_path 图片物理路径
     * @param  int $max_width    图片宽度
     * @return
     */
    public function reduceSize($file_path, $max_width)
    {
        // 先实例化，传参是文件的磁盘物理路径
        $image = Image::make($file_path);

        // 进行大小调整的操作
        $image->resize($max_width, null, function ($constraint) {

            // 设定宽度是 $max_width，高度等比例缩放
            $constraint->aspectRatio();

            // 防止裁图时图片尺寸变大
            $constraint->upsize();
        });

        // 对图片修改后进行保存
        $image->save();
    }
}
