<?php

class RuleComment
{
    public function message()
    {
        $msg = [
            'comment.required' => 'Bình luận không được để trống',
            'comment.used' => 'Bạn có thể dùng bình luận này',
        ];

        return $msg;
    }
}
