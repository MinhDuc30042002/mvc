<?php require_once('request/request.php'); ?>
<a href="index.php">
    <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Home
    </button>
</a>

<div class="m-auto mt-10 flex flex-col items-center bg-white rounded-lg border shadow-md md:flex-row md:w-3/4 hover:bg-gray-100">
    <?php foreach (json_decode($data['post']['image']) as $value) { ?>
        <img class="object-cover w-full h-96 rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="<?= 'upload/' . $value ?>" alt="">
    <?php } ?>

    <div class="w-full flex flex-col justify-between p-4 leading-normal">
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                <?= $data['post']['title'] ?>
            </h5>
            <p class="mb-3 font-normal text-gray-700">
                <?= $data['post']['content'] ?>
            </p>
        </div>
    </div>
</div>

<div class="mt-3 m-auto w-3/4 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200">
    <button aria-current="true" type="button" class="py-2 px-4 w-full font-medium text-left text-white bg-blue-700 rounded-t-lg border-b border-gray-200 cursor-pointer focus:outline-none">
        Bình luận
    </button>
    <?php foreach ($data['comment'] as $comments) { ?>
        <?php Request::render_comment(array('comments' => $comments, 'count' => 1)) ?>
    <?php } ?>
</div>

<form class="w-3/4 m-auto mt-8" action="index.php?controller=comment&action=store&id=<?= $data['post']['id'] ?>" method="post">
    <input onkeyup="commentPosts()" placeholder="Viết comment của bạn" id="comment" name="comment" type="text" class="mb-2 bg-black-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
    <button style="display: none" id="btn_comment" name="btn_comment" type="submit" class="mb-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2 text-center">Comment</button>
</form>


<script src="assets/js/index.js"></script>

<script>
    let title = document.getElementById('value_title')
    const btn_edit_post = document.getElementById('edit_post')

    title.onkeyup = function() {
        if (title.value.length == 0) {
            btn_edit_post.style.display = 'none'
            document.getElementById('error_title').innerHTML = 'Tiêu đề không được để trống'
        } else {
            btn_edit_post.style.display = 'block'
            document.getElementById('error_title').innerHTML = ''
        }
    }
</script>