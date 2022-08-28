<a href="index.php">
    <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Home
    </button>
</a>

<form action="index.php?controller=posts&action=store" enctype="multipart/form-data" method="POST" class="w-3/4 m-auto p-4">
    <h1 class="mb-4 text-lg">Thêm bài viết mới</h1>

    <div class="mb-6">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Tiêu đề</label>
        <input onkeyup="onKeyUpTitle()" id="title" name="title" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
        <p id="title_error" class="mt-2 text-pink-600 text-sm">
            <?= $data['alert'] ?? '' ?>
        </p>
    </div>

    <div class="mb-6">
        <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Nội dung</label>
        <textarea name="content" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
    </div>

    <div class="mb-6">
        <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Hình ảnh</label>
        <input id="file_image" name="image[]" multiple="multiple" type="file" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
        <section class="overflow-hidden text-gray-700 ">
            <div class="container px-5 py-2 mx-auto lg:pt-12 lg:px-32">
                <div class="flex flex-wrap -m-1 md:-m-2">
                    <div class="flex flex-wrap w-1/3">
                        <div class="w-full p-1 md:p-2">
                            <img id="image" class="block object-cover object-center w-full h-full rounded-lg">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <p class="mt-2 text-pink-600 text-sm">
            <?= $data['data']['path']['format'] ?? '' ?>
        </p>
    </div>

    <button style="display: none" id="posts" name="submit" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Đăng</button>
</form>

<script src="assets/js/index.js"></script>
