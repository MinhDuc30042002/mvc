<?php
session_start();

class Base
{
    protected $folder;

    public function render($file,  $data = array())
    {
        $view_file = 'views/' . $this->folder . '/' . $file . '.php';
        if (is_file($view_file)) {
            ob_start();
            require_once($view_file);
            $content = ob_get_clean();
            require_once('views/layout/app.php');
        }
    }
}
