<body class="bg-white font-family-karla h-screen">

    <div class="w-full flex flex-wrap">

        <!-- Login Section -->
        <div class="w-full md:w-1/2 flex flex-col">

            <div class="flex flex-col justify-center md:justify-start my-auto pt-8 md:pt-0 px-8 md:px-24 lg:px-32">
                <p class="text-center text-3xl">Welcome.</p>
                <form method="POST" action="index.php?controller=login" class="flex flex-col pt-3 md:pt-8">
                    <div class="flex flex-col pt-4">
                        <label for="email" class="text-lg">Địa chỉ email</label>
                        <input name="email" value="<?= $_POST['email'] ?? '' ?>" type="email" id="email" placeholder="your@email.com" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
                        <div class="text-red-600">
                            <?= $data['login']['email'] ?? ""; ?>
                        </div>
                    </div>

                    <div class="flex flex-col pt-4">
                        <label for="password" class="text-lg">Mật khẩu</label>
                        <input value="<?= $_POST['password'] ?? '' ?>" name="password" type="password" id="password" placeholder="Password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
                        <div class="text-red-600">
                            <?= $data['login']['password'] ?? ""; ?>
                        </div>
                    </div>
                    <div class="text-red-500 mb-3">
                        <?= $data['login']['unregister'] ?? ""; ?>
                    </div>
                    <button type="submit" value="Log In" class="bg-black text-white font-bold text-lg hover:bg-gray-700 p-2 mt-8">
                        Đăng nhập
                    </button>
                </form>
            </div>
        </div>

        <!-- Image Section -->
        <div class="w-1/2 shadow-2xl">
            <img class="object-cover w-full h-screen hidden md:block" src="https://source.unsplash.com/IXUM4cJynP0">
        </div>
    </div>

</body>