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

    public function edit()
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
            // header('location: index.php?controller=profile');
        }
        return $this->render('index', $data);
    }

    public function posts()
    {
        $posts = Posts::posts($_SESSION['i']);
        $data = ['title' => 'Posts Page', 'posts' => $posts];
        if (count($posts) == 0) {
            $null = 'Chưa có bài viết nào';
            $data += ['null' => $null];
        }
        return $this->render('posts', $data);
    }

    public function add()
    {
        return $this->render('add');
    }

    public function store()
    {
        $validate_profile = new ValidationProfile();
        $input = Request::get_all_inputs();
        $files = Request::path_image();


        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $type_allow = array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        );

        for ($i = 0; $i < count($files['tmp_name']); $i++) {
            $mime = $finfo->file($files['tmp_name'][$i]);
            $ext = array_search($mime, $type_allow, true);

            if ($ext == false) {
                echo 'false';
            } else {
                
            }
            // var_dump($mime);
        }

        // $target_file = $validate_profile->path_image($file);
        // $input += ['path' => $target_file];

        // $post = $validate_profile->store($input);

        // $clean_title = $validate_profile->strip_tags_content($input['title']);

        // if ($clean_title != '') {
        //     Posts::store($post['data']['content'], $clean_title, $post['data']['path']['image'], $_SESSION['i']);
        //     header('location: index.php?controller=profile&action=posts');
        // }

        // return $this->render('add', $post);
    }

    public function first()
    {
        $id = Request::firstOrFail();
        $posts = Posts::first($id);

        if ($posts['user_id'] == $_SESSION['i']) {
            return $this->render('show', $posts);
        } else {
            header('location: index.php?controller=error');
        }
    }

    public function update()
    {
        $id = Request::firstOrFail();
        $posts = Posts::first($id);

        $input = Request::get_all_inputs();
        $v = new ValidationProfile();

        if (isset($_FILES['img'])) {
            $file = $_FILES['img'];
            $ext = $v->path_image($file);
            $input += ['ext' => $ext];
        }

        $image = $input['ext']['image'] ?? $input['image'];

        if ($input['title'] != '') {
            Posts::update($input['title'], $input['content'], $image, $id);
            $_SESSION['updated'] = 'Cập nhật thành công';
            header('location: index.php?controller=profile&action=posts');
        }
        return $this->render('show', $posts);
    }

    public function destroy()
    {
        $id = Request::firstOrFail();
        Posts::destroy($id);
        $_SESSION['success'] = 'Đã xóa thành công';
        header('location: index.php?controller=profile&action=posts');
    }
}
