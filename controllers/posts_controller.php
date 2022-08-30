<?php
require_once('controllers/base_controller.php');
require_once('request/request.php');
require_once('models/comments.php');
require_once('models/posts.php');
require_once('validation/ValidationProfile.php');
require_once('validation/ValidationPosts.php');

class PostsController extends Base
{

    public function __construct()
    {
        $this->folder = 'posts';
        if (!isset($_SESSION['i'])) {
            header('location: index.php?controller=login');
        };
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
        $validate_posts = new ValidationPosts();
        $data = $validate_posts->store();
        $files = Request::path_image();


        $image = $validate_posts->path_image();


        $output = ['data' => $data];

        $title = $output['data']['title'];
        $content = $output['data']['content'];


        if ($title != '' && $image == '') {
            Posts::store($content, $title, json_encode($files['name']), $_SESSION['i']);
            $success = ['success' => 'Đã thêm thành công'];
            return $this->render('create', $success);
        } else {
            $output += ['mime' => $image];
            return $this->render('create', $output);
        }
    }

    public function update()
    {
        $id = $_GET['id'];
        $posts = Posts::first($id);
        $validate_posts = new ValidationPosts();

        $comment_by_id = Posts::all_comment_by_id($id);
        $output = $validate_posts->store();
        $data = ['title' => 'Page', 'output' => $output, 'post' => $posts, 'comment' => $comment_by_id];
        $title = $data['output']['data']['title']['title'];
        $content = $data['output']['data']['content'];

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        if ($title != '') {
            Posts::update($title, $content, $id);
            $_SESSION['updated'] = 'Cập nhật thành công';
            header('location: index.php?controller=posts');
        }
        return $this->render('show', $data);
    }

    public function destroy()
    {
        $id = $_GET['id'];
        Posts::destroy($id);
        $_SESSION['success'] = 'Đã xóa thành công';
        header('location: index.php?controller=posts');
    }
}
