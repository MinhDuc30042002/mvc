
<?php
require_once('controllers/base_controller.php');
require_once('models/user.php');
require_once('validation/ValidationUser.php');
require_once('request/request.php');
require_once('request/RuleUser.php');
require_once('middleware/permission.php');

class UsersController extends Base
{
    public $permission;
    public $hanlde;

    public function __construct()
    {
        $this->folder = 'users';
        $this->permission = new Permission();
        $this->hanlde = $this->permission->role();

        if (isset($_SESSION['i'])) {
            $id = $_SESSION['i'];
            if ($id != 141414) {
                header('location: index.php?controller=error');
            }
        };
    }

    public function index()
    {
        $users = User::all();
        $arr = array('title' => 'List User', 'users' => $users);
        return $this->render('index', $arr);
    }

    public function show()
    {
        $user = User::get_user();
        $data = array('title' => 'User Page', 'user' => $user);

        return $this->render('show', $data);
    }

    public function update()
    {
        $u = new ValidationUser();

        $user = User::get_user();
        $input = Request::get_all_inputs();
        $check = $u->update_user($user, $input);
        $data = [
            'v_user' => $check,
            'user' => $user
        ];

        if (!is_array($data['v_user']['update_user'])) {
            User::update($user->id, $data['v_user']['update_user']);
            header('location: index.php?controller=users');
        }
        return $this->render('show', $data);
    }

    public function destroy()
    {
        $find_user = Request::firstOrFail();
        User::delete($find_user);
        header('location: index.php?controller=users');
    }

    public function create()
    {
        return $this->render('create');
    }

    public function store()
    {
        $user = new ValidationUser();

        $data = Request::get_all_inputs();
        $input = $user->store_user($data);

        if (!is_array($input['user'])) {
            User::store($input['user']);
            header('location: index.php?controller=users');
        }
        return $this->render('create', $input);
    }
}
