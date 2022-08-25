<?php
require_once('request/RuleProfile.php');

class ValidationProfile extends RuleProfile
{
    public $msg;

    public function __construct()
    {
        $this->msg = $this->message();
    }

    public function exist_title($title)
    {
        $key = 'used';
        if (ValidationUser::check_empty($title)) {
            $key = 'required';
        }

        return $this->msg['title.' . $key];
    }

    public function allow_type($file)
    {
        // check mime type by yourseft
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $type_allow = array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        );
        $mime = $finfo->file($file['tmp_name']);
        // return text/plain
        $ext = array_search($mime, $type_allow, true);
        if ($ext === false) {
            $key = 'pattern';
            return $this->msg['file.' . $key];
        }
    }

    public function value_title($title)
    {
        $exist_title = $this->exist_title($title);
        $t = '';
        if ($exist_title == $this->msg['title.used']) {
            $t = $title;
        }
        $arr = array('alert' => $exist_title, 'title' => $t);
        return $arr;
    }

    public function path_image($path)
    {
        $path_image = $this->allow_type($path);
        $target_file = 'upload/' . $path['name'];
        $image = '';
        if ($path_image != $this->msg['file.pattern']) {
            if ($path['name'] == '') {
                $image = '';
            } else {
                move_uploaded_file($path['tmp_name'], $target_file);
                $image = $target_file;
            }
        }
        $arr = array('format' => $path_image, 'image' => $image);
        return $arr;
    }

    public function strip_tags_content($text)
    {
        $clean = trim(htmlspecialchars(strip_tags($text)));
        return $clean;
    }

    public function store($data)
    {
        $title = $this->value_title($data['title']);
        $arr = array('alert' => $title['alert'], 'data' => $data);
        return $arr;
    }
}
