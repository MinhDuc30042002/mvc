<?php

class Replies
{
    public $id;
    public $comment;
    public $comment_id;
    public $user_id;
    public $posts_id;
    public $created_at;
    public $id_reply;

    public function __construct($id, $comment, $user_id, $comment_id, $created_at, $id_reply)
    {
        $this->id = $id;
        $this->comment = $comment;
        $this->user_id = $user_id;
        $this->comment_id = $comment_id;
        $this->created_at = $created_at;
        $this->id_reply = $id_reply;
    }

    public static function store($comment, $user_id, $comment_id, $created_at, $id_reply)
    {
        $query = "INSERT INTO replies (comment, user_id, comment_id, created_at, id_reply) VALUES ('$comment', $user_id, $comment_id, '$created_at', $id_reply)";
        $db = DB::getInstance();
        $req = $db->prepare($query)->execute();
        return $req;
    }

    public static function destroy($id)
    {
        $query = "DELETE FROM comments WHERE id = $id";
        $db = DB::getInstance();
        $req = $db->prepare($query)->execute();

        return $req;
    }
}
