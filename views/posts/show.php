<a href="index.php">
    <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Home
    </button>
</a>
<?php
if (isset($_SESSION['success'])) { ?>
    <div id="toast-success" class="mt-2 flex items-center p-4 mb-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow" role="alert">
        <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-green-500 bg-green-100 rounded-lg">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ml-3 text-sm font-normal"><?= $_SESSION['success'] ?></div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8" data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
    <?php unset($_SESSION['success']) ?>
<?php } ?>
<?php
if (isset($_SESSION['failed'])) { ?>
    <div id="toast-warning" class="flex items-center p-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow" role="alert">
        <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-orange-500 bg-orange-100 rounded-lg">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Warning icon</span>
        </div>
        <div class="ml-3 text-sm font-normal"><?= $_SESSION['failed'] ?></div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8" data-dismiss-target="#toast-warning" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
    <?php unset($_SESSION['failed']) ?>
<?php } ?>

<div class="m-auto mt-10 flex flex-col items-center bg-white rounded-lg border shadow-md md:flex-row md:w-3/4 hover:bg-gray-100">
    <?php foreach (json_decode($data['post']['image']) as $value) { ?>
        <img class="object-cover w-full h-96 rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="<?= 'upload/' . $value ?>" alt="">
    <?php } ?>

    <?php if ($data['post']['user_id'] == $_SESSION['i']) { ?>
        <div class="w-full flex flex-col justify-between p-4 leading-normal">
            <form action="index.php?controller=posts&action=update&id=<?= $data['post']['id'] ?>" method="post">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 border border-black-500">
                    <input id="value_title" class="w-full" name="title" type="text" value="<?= $_POST['title'] ?? $data['post']['title'] ?>">
                </h5>
                <p class="mb-3 font-normal text-red-400"><?= $data['output']['data']['title']['alert'] ?? '' ?></p>
                <p class="mb-3 text-red-400" id="error_title"></p>
                <p class="mb-3 font-normal text-gray-700 ">
                    <textarea name="content" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"><?= $data['post']['content'] ?></textarea>
                </p>
                <button name="edit_post" id="edit_post" type="submit" class="flex-1 focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-2">Sửa</button>
            </form>
        </div>
    <?php } else { ?>
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                <?= $data['post']['title'] ?>
            </h5>
            <p class="mb-3 font-normal text-gray-700 ">
                <?= $data['post']['content'] ?>
            </p>
        </div>
    <?php } ?>

</div>
<div class="mt-3 m-auto w-3/4 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200">
    <button aria-current="true" type="button" class="py-2 px-4 w-full font-medium text-left text-white bg-blue-700 rounded-t-lg border-b border-gray-200 cursor-pointer focus:outline-none">
        Bình luận
    </button>
    <?php foreach ($data['comment'] as $value) { ?>
        <div class="flex">
            <button type="button" class="mt-1 py-2 px-4 w-full font-medium text-left border-b border-gray-200 cursor-pointer hover:bg-sky-100 hover:text-black-700">
                <p class="mb-1"><?= $value['name'] ?> - <?= $value['created_at'] ?> </p>
                <p id="value_comment"><?= $value['comment'] ?></p>
            </button>
            <?php if ($value['uid'] == $_SESSION['i']) { ?>
                <a href="index.php?controller=comment&action=show&id=<?= $value['icmt'] ?>">
                    <button name="edit_comment" id="edit_comment" type="submit" class="flex-1 focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-2">Sửa</button>
                </a>

                <a href="index.php?controller=comment&action=destroy&id=<?= $value['icmt'] ?>">
                    <button onclick="return confirm('Bạn muốn xóa bình luận này')" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-2">Xóa</button>
                </a>
            <?php } ?>
        </div>
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