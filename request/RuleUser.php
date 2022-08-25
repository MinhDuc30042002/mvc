<?php

class RuleUser
{
    public function message()
    {
        $arr = [
            'id.required' => 'ID bắt buộc',
            'id.unique' => 'ID này đã tồn tại',
            'name.required' => 'Tên bắt buộc',
            'email.required' => 'Email bắt buộc',
            'email.unique' => 'Đã có người sử dụng email này',
            'email.pattern' => 'Email phải có định dạng @ yahoo.com, gmail.com...',
            'password.required' => 'Mật khẩu bắt buộc',
            'password.pattern' => 'Ít nhất 8 ký tự, bao gồm 2 số và ít nhất 1 dấu chấm',
            'id.used' => 'Có thể sử dụng ID',
            'name.used' => 'Bạn có thể sử dụng tên này',
            'email.used' => 'Bạn có thể sử dụng email này',
            'password.used' => 'Bạn có thể sử dụng mật khẩu này',
        ];

        return $arr;
    }

    public function login()
    {
        $array = [
            'email.required' => 'Vui lòng nhập địa chỉ email',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'unregister' => 'Thông tin không chính xác',
        ];

        return $array;
    }
}
