<a href="index.php">
    <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Home
    </button>
</a>

<?php
if (isset($data['success'])) { ?>
    <div id="toast-success" class="mt-2 flex items-center p-4 mb-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow" role="alert">
        <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-green-500 bg-green-100 rounded-lg">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ml-3 text-sm font-normal"><?= $data['success'] ?></div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8" data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
<?php } ?>


<form action="index.php?controller=posts&action=store" enctype="multipart/form-data" method="POST" class="w-3/4 m-auto p-4">
    <h1 class="mb-4 text-lg">Thêm bài viết mới</h1>

    <div class="mb-6">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Tiêu đề</label>
        <input onkeyup="onKeyUpTitle()" value="<?= $_POST['title'] ?? '' ?>" id="title" name="title" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
        <p id="title_error" class="mt-2 text-pink-600 text-sm">
            <?= $data['data']['alert'] ?? '' ?>
        </p>
    </div>

    <div class="mb-6">
        <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Nội dung</label>
        <textarea name="content" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
    </div>

    <div class="mb-6">
        <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Hình ảnh</label>
        <input onclick="removeImage()" onchange="previewFiles()" id="file_image" name="image[]" multiple="multiple" type="file" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
        <section class="overflow-hidden text-gray-700 ">
            <div class="container px-5 py-2 mx-auto lg:pt-12 lg:px-32">
                <div class="flex flex-wrap -m-1 md:-m-2">
                    <div class="flex flex-wrap w-1/3">
                        <div class="w-full p-1 md:p-2">
                            <div id="preview">
                                <!-- <img id="image" src="" alt=""> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <p class="mt-2 text-pink-600 text-sm">
            <?= $data['mime'] ?? '' ?>
        </p>
    </div>

    <button id="posts" name="submit" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Đăng</button>
</form>

<script src="assets/js/index.js"></script>

<script>
    function previewFiles() {
        var preview = document.querySelector('#preview');
        var files = document.querySelector('input[type=file]').files;

        let image = document.querySelector('#image')


        function readAndPreview(file) {
            var reader = new FileReader();


            let allow_type = ['image/png', 'image/jpeg', 'image/jpg']
            let type = allow_type.find(t => t == file.type)
            if (type) {
                reader.addEventListener("load", function(event) {
                    // khi gọi đối tượng Image này mặc định constructor sẽ tạo 1 thẻ image
                    let image = new Image();
                    // image.src = event.target.result
                    image.src = reader.result;
                    image.setAttribute('class', 'image')
                    preview.appendChild(image);
                }, false);

                reader.readAsDataURL(file);
            }
        }


        if (files) {
            [].forEach.call(files, readAndPreview);
        }
    }


    function removeImage() {
        let f = document.querySelector('input[type=file]')

        f.addEventListener("click", function() {
            let img = document.querySelectorAll('img')
            img.forEach(element => element.remove())
        })
    }


    let error_title = document.getElementById('title_error')

    if (error_title.innerText == 'Bạn có thể dùng tiêu đề này') {
        error_title.style.color = 'green'
    }
</script>