<?php

class RuleProfile
{
    public function message()
    {
        $msg = [
            'title.required' => 'Tiêu đề không được để trống',
            'title.used' => 'Bạn có thể dùng tiêu đề này',
            'file.pattern' => 'File hình ảnh chỉ có dạng jpg, png, jpeg, gif',
        ];

        return $msg;
    }
}
