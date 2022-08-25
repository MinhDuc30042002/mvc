<?php
require_once('controllers/base_controller.php');
require_once('models/posts.php');
require_once('models/comments.php');

class NewFeedController extends Base
{

    public function __construct()
    {
        $this->folder = 'newfeed';
    }

    public function index()
    {
        $newfeed = Posts::all();

        $arr = array('title' => 'Newfeed Page', 'nf' => $newfeed);
        return $this->render('index', $arr);
    }


    public function posts()
    {
        $posts_id = Request::firstOrFail();
    }
}
