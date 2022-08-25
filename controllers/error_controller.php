<?php

require_once('controllers/base_controller.php');
class ErrorController extends Base
{
    public function __construct()
    {
        $this->folder = 'error';
    }

    public function error()
    {
        $error = 'Error';
        $title = 'Error Page';

        $data = array('error' => $error, 'title' => $title);

        if (isset($_SESSION['id']) != null) {
            $data += ['session_error' => $_SESSION['id']];
            $this->render('error', $data);
            unset($_SESSION['id']);
        } else {
            $data += ['session_error' => null];
            $this->render('error', $data);
        }
    }
}
