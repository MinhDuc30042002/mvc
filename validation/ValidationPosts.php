<?php

class ValidationPosts extends RuleProfile
{
    public $msg;

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

            if ($file['tmp_name'] != '') {
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

    public function update_post($post)
    {
        $input = Request::get_all_inputs();
        $data = array();
        // Check if user change value
        if ($input['title'] != $post['title']) {
            $title = $this->value_title(Request::replace_tag($input['title']));
        } else {
            $title = ['alert' => '', 'title' => $post['title']];
        }

        if ($input['content'] != $post['content']) {
            $content = Request::replace_tag($input['content']);
        } else {
            $content = $post['content'];
        }

        // Check user change image
        if (isset($_FILES['image'])) {
            $files = $_FILES['image'];
            $image = $this->path_image();
            if ($image == '') {
                $path_image = ['error_img' => '', 'img' => json_encode($files['name'])];
            } else {
                $path_image = ['error_img' => $image, 'img' => ''];
            }
        } else {
            $path_image = ['error_img' => '', 'img' => $post['image']];
        }

        $data = ['title' => $title, 'content' => $content, 'image' => $path_image];
        return $data;
    }
}
