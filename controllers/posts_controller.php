<?php
require_once('controllers/base_controller.php');
require_once('request/request.php');
require_once('models/comments.php');
require_once('models/posts.php');
require_once('validation/ValidationProfile.php');
require_once('validation/ValidationPosts.php');
require_once('validation/ValidationComments.php');

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
        $page = '';
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            if (empty($page)) {
                $page = 1;
            }
        } else {
            $page = 1;
        }

        $pagination = Request::pagination($posts);
        return $this->render('posts_by_user', $data);
    }

    public function show()
    {
        $id = $_GET['id'];
        $posts = Posts::first_posts($id);

        $comments = Posts::all_comment($id);
        $cmt_main = array();

        // O(n)
        // Example 10 comment 
        // $comment : 10 
        // is_null($comment['id_reply']) : 10
        // 2 => $comment['id_reply'] == 0 : 2
        foreach ($comments as $comment) {
            if (is_null($comment['id_reply'])) {
                $cmt_main[$comment['icmt']] = $comment;
            }
        }

        foreach ($comments as $replies_level_1) {

            if (isset($cmt_main[$replies_level_1['id_reply']]['icmt'])) {
                $id_comment = $cmt_main[$replies_level_1['id_reply']]['icmt'];

                if ($id_comment == $replies_level_1['id_reply']) {
                    $cmt_main[$id_comment]['replies'][$replies_level_1['icmt']] = $replies_level_1;
                }

                foreach ($comments as $replies_level_2) {
                    if (isset($cmt_main[$id_comment]['replies'][$replies_level_1['icmt']])) {
                        $id_replies_level_1 = $cmt_main[$id_comment]['replies'][$replies_level_1['icmt']]['icmt'];

                        if ($id_replies_level_1 == $replies_level_2['id_reply']) {
                            $cmt_main[$id_comment]['replies'][$replies_level_1['icmt']]['replies'][$replies_level_2['icmt']] = $replies_level_2;
                        }
                    }
                }
            }
        }
        $data = ['post' => $posts, 'comment' => $cmt_main];
        return $this->render('show', $data);
    }

    public function create()
    {
        return $this->render('create');
    }

    public function edit()
    {

        $id = $_GET['id'];
        $posts = Posts::first_posts($id);
        $data = ['data' => $posts];
        return $this->render('edit', $data);
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
        $validate_posts = new ValidationPosts();

        $id = $_GET['id'];
        $post = Posts::first_posts($id);
        $output = $validate_posts->update_post($post);

        $data = ['data' => $post, 'output' => $output];

        $title = $data['output']['title']['title'];
        $content = $data['output']['content'];
        $image = $data['output']['image']['img'];

        if ($title != '' && $image != '') {
            Posts::update($title, $content, $id, $image);
            header('location: index.php?controller=posts');
        }
        return $this->render('edit', $data);
    }

    public function destroy()
    {
        $id = $_GET['id'];
        Posts::destroy($id);
        $_SESSION['success'] = 'Đã xóa thành công';
        header('location: index.php?controller=posts');
    }
}
