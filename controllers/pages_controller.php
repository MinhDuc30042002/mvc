<?php

require_once('controllers/base_controller.php');

class PagesController extends Base
{

    public function __construct()
    {
        $this->folder = 'pages';
    }

    public function home()
    {
        if (isset($_SESSION['i'])) {
            $user = User::findOrFail($_SESSION['i']);
        }

        $data = array(
            'title' => 'Home',
            'user' => $user ?? []
        );
        $this->render('home', $data);
    }
}
