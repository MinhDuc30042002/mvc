<?php
require_once('models/user.php');

class Request
{
    public static function firstOrFail()
    {
        if (empty($_GET['id'])) {
            header('location: index.php?controller=error');
        } else if (User::id_unique($_GET['id']) == 0) {
            $_SESSION["id"] = "Don't have any id similar";
            header('location: index.php?controller=error');
        } else {
            $id = $_GET['id'];
        }
        return $id;
    }

    public static function check_empty($str)
    {
        return strlen($str) == 0 ? TRUE : FALSE;
    }

    public static function replace_tag($str)
    {
        return htmlspecialchars(strip_tags(trim($str)));
    }

    public static function get_all_inputs()
    {
        $input_data = $_POST;
        return $input_data;
    }

    public static function path_image()
    {
        $file = $_FILES['image'];
        return $file;
    }

    public static function reArrayFiles($file_post)
    {
        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }

        return $file_ary;
    }
}
