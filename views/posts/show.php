<a href="index.php">
    <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Home
    </button>
</a>

<div class="m-auto mt-10 flex flex-col items-center bg-white rounded-lg border shadow-md md:flex-row md:w-3/4 hover:bg-gray-100">
    <?php foreach (json_decode($data['post']['image']) as $value) { ?>
        <img class="object-cover w-full h-96 rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="<?= 'upload/'. $value ?>" alt="">
    <?php } ?>
    <div class="flex flex-col justify-between p-4 leading-normal">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900"><?= $data['post']['title'] ?></h5>
        <p class="mb-3 font-normal text-gray-700 ">
            <?= $data['post']['content'] ?>
        </p>
    </div>
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
                    <button name="edit_comment" id="edit_comment" type="submit" class="flex-1 focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-2">Edit</button>
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
    const btn_edit_comment = document.getElementById('edit_comment')
    let value_comment = document.getElementById('value_comment')

    function changeTag() {
        let input = document.createElement('input')
        input.setAttribute('type', 'text')

        input.appendChild(value_comment)
    }
</script>