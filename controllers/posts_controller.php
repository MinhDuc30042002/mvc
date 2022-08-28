<?php
require_once('controllers/base_controller.php');
require_once('request/request.php');
require_once('models/comments.php');
require_once('models/posts.php');
require_once('validation/ValidationProfile.php');
class PostsController extends Base
{

    public function __construct()
    {
        $this->folder = 'posts';
    }

    public function index()
    {
        $posts = Posts::posts($_SESSION['i']);
        $data = ['title' => 'Posts Page', 'posts' => $posts];
        if (count($posts) == 0) {
            $null = 'Chưa có bài viết nào';
            $data += ['null' => $null];
        }
        return $this->render('posts_by_user', $data);
    }

    public function show()
    {
        $id = $_GET['id'];
        $posts = Posts::first_posts($id);
        $comment_by_id = Posts::all_comment_by_id($id);

        $data = ['post' => $posts, 'comment' => $comment_by_id];
        return $this->render('show', $data);
    }

    public function create()
    {
        return $this->render('create');
    }

    public function store()
    {
        $validate_profile = new ValidationProfile();
        $input = Request::get_all_inputs();
        $files = Request::path_image();

        $files_array = Request::reArrayFiles($files);
        foreach ($files_array as $file) {
            $target_file = 'upload/' . $file['name'];
            move_uploaded_file($file['tmp_name'], $target_file);
        }

        // // -------------------------------------------

        // // $target_file = $validate_profile->path_image($file);
        // // $post = $validate_profile->store($input);
        // $clean_title = $validate_profile->strip_tags_content($input['title']);

        // $input += ['path' => $files['name']];

        // var_dump($clean_title);
        // // var_dump($input);

        // if ($input['title'] != '') {
        //     Posts::store($input['content'], $input['title'], json_encode($files['name']), $_SESSION['i']);
        //     header('location: index.php?controller=profile&action=posts');
        // }

        // return $this->render('add', $input);
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
