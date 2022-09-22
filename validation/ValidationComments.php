
<?php
require_once('request/RuleComment.php');
require_once('models/posts.php');
class ValidationComments extends RuleComment
{
    public $msg;

    public function __construct()
    {
        $this->msg = $this->message();
    }

    public function empty_comment($str)
    {
        return strlen($str) == 0 ? TRUE : FALSE;
    }

    public function check_empty_comment($comment)
    {
        $key = 'used';
        if ($this->empty_comment($comment)) {
            $key = 'required';
        }
        return $this->msg['comment.' . $key];
    }

    public function arr_comment($comment)
    {
        $arr = array();
        $comment = Request::replace_tag($comment);
        if ($this->check_empty_comment($comment) == $this->msg['comment.used']) {
            return $arr += ['comment' => $comment, 'error' => $this->check_empty_comment($comment)];
        } else {
            return $arr += ['comment' => '', 'error' => $this->check_empty_comment($comment)];
        }
    }
}
