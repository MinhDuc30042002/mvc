
<?php
require_once('controllers/login_controller.php');
require_once('middleware/permission.php');

$permission = new Permission();

$controllers = array(
    // Trang chủ
    'pages' => ['home'],

    // Trang login (Trang chủ form login ,đăng nhập, đăng xuất)
    'login' => ['index', 'logout'],

    // Trang quản lí user của admin (admin)
    // CRUD và danh sách người dùng (admin)
    'users' => ['index', 'show', 'update', 'destroy', 'create', 'store'],

    // Thông tin người dùng (client)
    // Thông tin cá nhân
    'profile' => ['index', 'update'],

    // Trang newfeed (client)
    'newfeed' => ['index'],

    // Bài viết của người dùng (client)
    'posts' => ['create', 'show', 'store', 'index', 'destroy', 'update'],

    // Bình luận của người dùng (client)
    'comment' => ['destroy', 'show', 'edit', 'store']
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
