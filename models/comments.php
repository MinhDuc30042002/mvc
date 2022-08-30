<?php


class Comment
{
    public $id;
    public $content;
    public $user_id;
    public $posts_id;
    public $created_at;
    public $updated_at;

    public function __construct($id, $content, $user_id, $posts_id, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->content = $content;
        $this->user_id = $user_id;
        $this->posts_id = $posts_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public static function comment($comment, $user_id, $posts_id, $created_at)
    {
        $query = "INSERT INTO comments (comment, user_id, posts_id, created_at) VALUES ('$comment', $user_id, $posts_id, '$created_at')";
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

    public static function comment_by_id($id)
    {
        $db = DB::getInstance();
        $query = "SELECT * FROM comments WHERE id = $id";
        $req = $db->prepare($query);
        $req->execute();
        $item = $req->fetch();
        return $item;
    }

    public static function update_comment($id, $comment, $created_at)
    {
        $query = "UPDATE comments SET comment = '$comment', created_at = '$created_at' WHERE id = $id";
        $db = DB::getInstance();
        $req = $db->prepare($query)->execute();

        return $req;
    }
}
