<a href="index.php">
    <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Home
    </button>
</a>


<form action="index.php?controller=posts&action=update&id=<?= $data['data']['id'] ?>" enctype="multipart/form-data" method="POST" class="w-3/4 m-auto p-4">
    <h1 class="mb-4 text-lg">Thêm bài viết mới</h1>

    <div class="mb-6">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Tiêu đề</label>
        <input onkeyup="onKeyUpTitle()" value="<?= $_POST['title'] ?? $data['data']['title'] ?>" id="title" name="title" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
        <p id="title_error" class="mt-2 text-pink-600 text-sm">
            <?= $data['output']['title']['alert'] ?? '' ?>
        </p>
    </div>

    <div class="mb-6">
        <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Nội dung</label>
        <textarea name="content" id="message" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"><?php echo $data['data']['content'] ?></textarea>
    </div>

    <div class="mb-6">

        <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Hình ảnh</label>
        <input onchange="previewFiles()" value="Thay đổi" id="file_image" name="image[]" multiple="multiple" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
        <p class="mt-2 text-pink-600 text-sm">
            <?= $data['output']['image']['error_img'] ?? '' ?>
        </p>
        <?php foreach (json_decode($data['data']['image']) as $image) { ?>
            <section class="overflow-hidden text-gray-700 ">
                <div class="container px-5 py-2 mx-auto lg:pt-12 lg:px-32">
                    <div class="flex flex-wrap -m-1 md:-m-2">
                        <div class="flex flex-wrap w-1/3">
                            <div class="w-full p-1 md:p-2">
                                <div class="flex" id="preview">
                                    <img class="value_img h-60" src="<?= 'upload/' . $image ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>

    </div>

    <button id="update" type="submit" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Chỉnh sửa</button>

</form>

<script src="assets/js/index.js"></script>
<script>
    let file_image = document.getElementById('file_image')
    let old_image = document.querySelectorAll('img')

    file_image.addEventListener('click', () => {
        if (file_image.type == 'text') {
            file_image.type = 'file'
            file_image.setAttribute('name', 'image[]')
        }
    })
</script>