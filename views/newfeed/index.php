<a href="index.php">
    <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Home
    </button>
</a>
<br>

<?php foreach ($data['posts'] as $news) { ?>
    <div class="m-auto mb-2 max-w-lg bg-white rounded-lg border border-gray-200 shadow-md">
        <?php foreach (json_decode($news['image']) as $image) { ?>
            <img class="rounded-t-lg" src="<?= 'upload/' . $image ?>">
        <?php } ?>
        <div class="p-5">
            <p class="mb-6 font-normal text-gray-700">Người đăng : <b><?= $news['name'] ?></b></p>
            <a href="index.php?controller=posts&action=show&id=<?= $news['id_posts'] ?>">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 underline">
                    <?= $news['title'] ?>
                </h5>
            </a>
            <p class="mb-3 font-normal text-gray-700 overflow-y-hidden h-20"><?= $news['content'] ?></p>
        </div>
    </div>
<?php } ?>

<nav aria-label="Page navigation example">
    <ul class="inline-flex items-center -space-x-px justify-items-center m-8">
        <?php if ($data['p'] != 1) : ?>
            <li class="first">
                <a href="index.php?controller=newfeed&page=1" class="block py-2 px-3 ml-0 leading-tight text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                    First
                </a>
            </li>
            <li class="previous">
                <a href="index.php?controller=newfeed&page=<?= $data['p'] - 1 == 0 ? 1 : $data['p'] - 1 ?>" class="block py-2 px-3 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                    <span class="sr-only">Previous</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </a>
            </li>
        <?php endif; ?>
        <?php for ($i = $data['to']; $i <= $data['from']; $i++) { ?>
            <li>
                <a href="index.php?controller=newfeed&page=<?= $i ?>" class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                    <?= $i ?>
                </a>
            </li>
        <?php } ?>
        <?php if ($data['p'] == $data['pagination']) { ?>
            <li style="display: none;" class="next ml-2">
                <a href="index.php?controller=newfeed&page=<?= $data['p'] + 1 ?>" class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                    <span class="sr-only">Next</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </a>
            </li>
            <li style="display: none;" class="last">
                <a href="index.php?controller=newfeed&page=<?= $data['pagination'] ?>" class="block py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                    Last
                </a>
            </li>
        <?php } else { ?>
            <li class="next">
                <a href="index.php?controller=newfeed&page=<?= $data['p'] + 1 ?>" class="block py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                    <span class="sr-only">Next</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </a>
            </li>
            <li class="last">
                <a href="index.php?controller=newfeed&page=<?= $data['pagination'] ?>" class="block py-2 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                    Last
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>