<?php
require_once('controllers/base_controller.php');
require_once('models/comments.php');
require_once('models/replies.php');
require_once('request/request.php');
require_once('validation/ValidationComments.php');
class RepliesController extends Base
{

    public function __construct()
    {
        $this->folder = 'replies';
    }

    public function create()
    {
        return $this->render('create');
    }

    public function store()
    {
        $id_cmt = $_GET['id'];
        $validation_comment = new ValidationComments();
        $comment = $validation_comment->arr_comment($_POST['comment']);
        $comments = Comment::comment_by_id($id_cmt);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $created_at = date('F j, Y, g:i a');

        if ($comment['comment'] != '') {
            Comment::replies_commemt($comment['comment'], $_SESSION['i'], $comments['posts_id'], $created_at, $id_cmt);
            header('location: index.php?controller=posts&action=show&id=' . $comments['posts_id']);
        }

        return $this->render('create', $comment);
    }

    public function destroy()
    {
        Replies::destroy($_GET['id']);
        header('location:' . $_SERVER['HTTP_REFERER']);
    }
}
