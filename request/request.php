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
}
