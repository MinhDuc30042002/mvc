<a href="index.php">
    <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Home
    </button>
</a>

<form action="index.php?controller=replies&action=store&id=<?= $_GET['id'] ?>" method="POST" class="w-3/4 m-auto mt-3">
    <div class="mb-6">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Bình luận</label>
        <input id="comment" name="comment" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        <p class="mb-3 text-red-400" id="error_comment"><?php echo $data['error'] ?? '' ?></p>
    </div>
    <button id="edit_comment" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Trả lời</button>
</form>


<script>
    let comment = document.getElementById('comment')
    let btn_edit_comment = document.getElementById('edit_comment')

    comment.onkeyup = function() {
        if (comment.value.length == 0) {
            btn_edit_comment.style.display = 'none'
            document.getElementById('error_comment').innerHTML = 'Bình luận không được để trống'
        } else {
            btn_edit_comment.style.display = 'block'
            document.getElementById('error_comment').innerHTML = ''
        }
    }
</script>