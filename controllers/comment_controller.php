<?php
require_once('controllers/base_controller.php');
require_once('request/request.php');
require_once('models/comments.php');

class CommentController extends Base
{

    public function __construct()
    {
        $this->folder = 'comment';
    }

    public function index()
    {
    }

    public function show()
    {
        $id = $_GET['id'];
        $comment = Comment::comment_by_id($id);
        return $this->render('edit', $comment);
    }


    public function edit()
    {
        $id = $_GET['id'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $updated_at = date('F j, Y, g:i a');
        $content = $_POST['comment'];
        Comment::update_comment($id, $content, $updated_at);
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function destroy()
    {
        $id_comment = Request::firstOrFail();
        Comment::destroy($id_comment);
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function store()
    {

        $comment = $_POST['comment'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $created_at = date('F j, Y, g:i a');
        Comment::comment($comment, $_SESSION['i'], $_GET['id'], $created_at);
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }
}
