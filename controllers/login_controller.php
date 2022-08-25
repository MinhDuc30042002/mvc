<?php
require_once('controllers/base_controller.php');
require_once('request/request.php');
require_once('auth/authentication.php');

class LoginController extends Base
{

    public function __construct()
    {
        $this->folder = 'login';
    }

    public function index()
    {
        $login = new Authentication();

        $data = array('title' => 'Login Page');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $all_input = Request::get_all_inputs();
            $login = $login->auth($all_input);
            $data += ['login' => $login];

            if (!is_array($data['login'])) {
                $_SESSION['i'] = $data['login']->id;
                header('location: index.php');
            }
        }

        return $this->render('index', $data);
    }

    public function logout()
    {
        session_destroy();
        header('location: index.php');
    }
}
