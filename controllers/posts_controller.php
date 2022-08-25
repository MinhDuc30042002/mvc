<?php
require_once('controllers/base_controller.php');
require_once('request/request.php');
require_once('models/comments.php');
require_once('models/posts.php');

class PostsController extends Base
{

    public function __construct()
    {
        $this->folder = 'posts';
    }

    public function show()
    {
        $id_posts = Request::firstOrFail();

        $posts = Posts::first_posts();
        $comment_by_id = Posts::all_comment_by_id($id_posts);

        $data = ['post' => $posts, 'comment' => $comment_by_id];
        return $this->render('index', $data);
    }

    public function store()
    {
        $id_posts = Request::firstOrFail();

        $comment = $_POST['comment'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $created_at = date('F j, Y, g:i a');
        Comment::comment($comment, $_SESSION['i'], $id_posts, $created_at);
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }

    
}
