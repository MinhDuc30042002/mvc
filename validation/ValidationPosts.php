<?php

class ValidationPosts extends RuleProfile
{
    public $msgs;

    public function __construct()
    {
        $this->msg = $this->message();
    }

    public function allow_type($type_files)
    {
        // check mime type by yourseft
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $type_allow = array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        );
        $mime = $finfo->file($type_files);
        // return text/plain
        $ext = array_search($mime, $type_allow, true);
        if ($ext === false) {
            $key = 'pattern';
            return $this->msg['file.' . $key];
        }
    }

    public function path_image()
    {
        $error = '';

        $files = Request::path_image();
        $f = Request::reArrayFiles($files);

        foreach ($f as $file) {
            $target_file = 'upload/' . $file['name'];

            // Kiểm tra người dùng có truyền hình ảnh ?
            if ($file['tmp_name'] != '') {
                // Nếu có ảnh thì kiểm tra mime của ảnh đó
                $path_image = $this->allow_type($file['tmp_name']);

                // path_image return string
                if ($path_image != $this->msg['file.pattern']) {
                    move_uploaded_file($file['tmp_name'], $target_file);
                } else {
                    return $path_image;
                }
            }
        }
        return $error;
    }

    public function exist_title($title)
    {
        $key = 'used';
        if (ValidationUser::check_empty($title)) {
            $key = 'required';
        }
        return $this->msg['title.' . $key];
    }

    public function value_title($title)
    {
        $exist_title = $this->exist_title(Request::replace_tag($title));
        $t = '';
        if ($exist_title == $this->msg['title.used']) {
            $t = $title;
        }
        $arr = array('alert' => $exist_title, 'title' => $t);
        return $arr;
    }

    public function store()
    {
        $input = Request::get_all_inputs();

        $title = $this->value_title(Request::replace_tag($input['title']));
        $content = Request::replace_tag($input['content']);

        $arr = ['title' => $title['title'], 'content' => $content, 'alert' => $title['alert']];
        return $arr;
    }

    public function strip_tags_content($text)
    {
        $clean = trim(htmlspecialchars(strip_tags($text)));
        return $clean;
    }
}
