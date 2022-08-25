<a href="index.php">
    <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Home
    </button>
</a>
<br>

<!-- Modal toggle -->
<a href="index.php?controller=profile&action=add">
    <button id="button" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Thêm bài viết
    </button>
</a>


<form action="index.php?controller=profile&action=update&id=<?= $data['id'] ?>" method="POST" enctype="multipart/form-data" class="w-3/4 m-auto">
    <div class="mb-6">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
        <input onkeyup="onKeyUpTitle()" id="title" value="<?= $data['title'] ?>" type="text" name="title" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        <p id="title_error">

        </p>
    </div>
    <div class="mb-6">
        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 ">Content</label>
        <textarea name="content" id="message" rows="10" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"><?= $_POST['content'] ?? trim($data['content']) ?></textarea>
    </div>
    <div class="mb-6">
        <label class="block mb-2 text-sm font-medium text-gray-900">Image</label>
        <input onchange="loadFile(event)" type="text" name="image" id="value_image" value="<?= $data['image'] ?>" onclick="(this.type='file'), (this.name='img')" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        <figure class="max-w-lg">
            <img class="max-w-full h-auto rounded-lg" id="image">
        </figure>
    </div>
    <br>
    <button id="posts" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Chỉnh sửa bài viết</button>
</form>

<script>
    const value_image = document.getElementById('value_image')
    const image = document.getElementById('image')

    image.src = value_image.value
</script>

<script src="assets/js/index.js"></script>