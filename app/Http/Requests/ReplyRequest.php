<?php

namespace App\Http\Requests;

class ReplyRequest extends Request
{
    public function rules()
    {
        // 提交的时候 评论至少两个字符的长度
        return [
            'content' => 'required|min:2',
        ];
    }

}
