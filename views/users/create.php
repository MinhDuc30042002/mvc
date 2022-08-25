<form action="index.php?controller=users&action=store" method="POST" class="w-3/4 m-auto p-4">
    <div class="mb-6">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">ID</label>
        <input value="<?= $_POST['id'] ?? ''; ?>" name="id" type="text" id="id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
        <?= $data['errors']['id'] ?? ""; ?>
    </div>
    <div class="mb-6">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Địa chỉ email</label>
        <input value="<?= $_POST['email'] ?? ''; ?>" name="email" type="text" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
        <?= $data['errors']['email'] ?? ""; ?>
    </div>
    <div class="mb-6">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Họ tên</label>
        <input value="<?= $_POST['name'] ?? '' ?>" name="name" type="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
        <?= $data['errors']['name'] ?? ''; ?>

    </div>
    <div class="mb-6">
        <label for="pass" class="block mb-2 text-sm font-medium text-gray-900">Mật khẩu</label>
        <input value="<?= $_POST['pass'] ?? '' ?>" name="pass" type="password" id="pass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
        <?= $data['errors']['password'] ?? ''; ?>
    </div>

    <button name="submit" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
</form>