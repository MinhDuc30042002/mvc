
<?php
require_once('controllers/login_controller.php');
require_once('middleware/permission.php');

$permission = new Permission();

$controllers = array(
    'pages' => ['home'],
    'login' => ['index', 'login', 'logout'],
    'users' => ['profile', 'edit', 'index', 'show', 'update', 'destroy', 'create', 'store'],
    'profile' => ['index', 'edit', 'posts', 'add', 'store', 'first', 'update', 'destroy'],
    'newfeed' => ['index', 'edit', 'posts'],
    'posts' => ['show', 'store', 'edit'],
    'comment' => ['destroy', 'show', 'edit']
);



// Check controller

if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
    $controller = 'error';
    $action = 'error';
};

include_once('controllers/' . $controller . '_controller.php');
$klass = str_replace('_', '', ucwords($controller, '_')) . 'Controller';
$controller = new $klass;
$controller->$action();
