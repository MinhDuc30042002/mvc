<a href="index.php">
    <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Home
    </button>
</a>
<br>

<?php foreach ($data['nf'] as $news) { ?>
    <div class="m-auto mb-2 max-w-lg bg-white rounded-lg border border-gray-200 shadow-md">
        <img class="rounded-t-lg" src="<?= $news['image'] ?>">
        <div class="p-5">
            <a href="index.php?controller=posts&action=show&id=<?= $news['id_posts'] ?>">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 underline">
                    <?= $news['title'] ?>
                </h5>
            </a>
            <p class="mb-3 font-normal text-gray-700"><?= $news['content'] ?></p>
            <p class="mb-6 font-normal text-gray-700">Người đăng : <b><?= $news['name'] ?></b></p>
        </div>
    </div>
<?php } ?>