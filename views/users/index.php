<div class="p-4 flex justify-between">
    <a href="index.php?controller=users&action=create">
        <button type="button" class="m-auto focus:outline-none text-white bg-green-400 hover:bg-green-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">Thêm</button>
    </a>
    <?php if (isset($_SESSION['name'])) { ?>
        <?= 'Xin chào ' . $_SESSION['name'] ?>
    <?php } ?>


    <a href="index.php?controller=login&action=logout">
        <button type="button" class="m-auto focus:outline-none text-white bg-green-400 hover:bg-green-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">Đăng xuất</button>
    </a>
</div>

<div class="overflow-x-auto relative">
    <table class="w-full m-auto text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    ID
                </th>
                <th scope="col" class="py-3 px-6">
                    Name
                </th>
                <th scope="col" class="py-3 px-6">
                    Email
                </th>
                <th scope="col" class="py-3 px-6">
                    Password
                </th>
                <th scope="col" class="py-3 px-6">
                    Function
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['users'] as $user) { ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?= $user->id ?>
                    </th>
                    <td class="py-4 px-6">
                        <?= $user->name ?>
                    </td>
                    <td class="py-4 px-6">
                        <?= $user->email ?>
                    </td>
                    <td class="py-4 px-6">
                        <?= $user->password ?>
                    </td>
                    <td class="py-4 px-6">
                        <a onclick="return confirm('Are u sure ?')" href="index.php?controller=users&action=destroy&id=<?= $user->id ?>">
                            <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                        </a>
                        <a href="index.php?controller=users&action=show&id=<?= $user->id ?>">
                            <button type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">Edit</button>
                        </a>

                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>