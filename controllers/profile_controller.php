<?php
require_once('controllers/base_controller.php');
require_once('middleware/permission.php');
require_once('models/posts.php');
require_once('validation/ValidationProfile.php');

class ProfileController extends Base
{
    public $permission;
    public $hanlde;

    public function __construct()
    {
        $this->folder = 'profile';

        $this->permission = new Permission();
        $this->hanlde = $this->permission->role();
    }

    public function index()
    {
        $user = User::findOrFail($_SESSION['i']);
        $data = ['user' => $user];
        return $this->render('index', $data);
    }

    public function update()
    {
        $validate = new ValidationUser();

        $user = User::findOrFail($_SESSION['i']);
        $input = Request::get_all_inputs();
        $v_user = $validate->edit($user, $input);

        $data = [
            'user' => $user,
            'edit_user' => $v_user
        ];

        $name = $data['edit_user']['update_user']['name'];
        $email = $data['edit_user']['update_user']['email'];
        $pwd = $data['edit_user']['update_user']['pass'];

        if ($name != '' && $email != '' && $pwd != '') {
            // Execute edit user
            User::edit($user->email, $name, $email, $pwd);
            $_SESSION['success'] = 'Đã cập nhật';
        }
        return $this->render('index', $data);
    }

}
