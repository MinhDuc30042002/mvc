<?php
require_once('controllers/base_controller.php');
require_once('models/posts.php');
require_once('models/comments.php');

class NewFeedController extends Base
{

    public function __construct()
    {
        $this->folder = 'newfeed';
        if (!isset($_SESSION['i'])) {
            header('location: index.php?controller=login');
        };
    }

    public function index()
    {
        $number_of_result = Posts::pagination();
        $page = '';
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            if (empty($page)) {
                $page = 1;
            }

            if ($page > $number_of_result) {
                header('location: index.php?controller=error');
                // $page = $number_of_result;
            }
        } else {
            $page = 1;
        }
        $to = $page - 2 < 1 ? 1 : $page - 2;
        $from = $page + 2 > $number_of_result ? $number_of_result : $page + 2;

        $posts = Posts::limit_post($page);

        $arr = array('title' => 'Newfeed Page', 'pagination' => $number_of_result, 'posts' => $posts, 'p' => $page, 'to' => $to, 'from' => $from);
        return $this->render('index', $arr);
    }
}
