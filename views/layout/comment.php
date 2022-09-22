<?php require_once('request/request.php'); ?>

<div class="contain p-4 bg-blue-100 mt-2">
    <?php echo $count ?? '' ?>
    <p> <?= $comments['name'] ?> - <?= $comments['created_at'] ?></p>
    <p><?= $comments['comment'] ?> </p>
    <a href="index.php?controller=replies&action=create&id=<?= $comments['icmt'] ?>">
        <button type="button" class="mt-2 focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 mr-1 mb-1">Trả lời</button>
    </a>

    <?php if ($comments['uid'] == $_SESSION['i']) { ?>
        <!-- controller destroy -->
        <a href="index.php?controller=comment&action=show&id=<?= $comments['icmt'] ?>">
            <button type="button" class="mt-2 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 mr-1 mb-1">Sửa</button>
        </a>
        <a href="index.php?controller=comment&action=destroy&id=<?= $comments['icmt'] ?>">
            <button type="button" class="mt-2 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 mr-1 mb-1">Xóa</button>
        </a>
    <?php } ?>

    <?php
    if (isset($comments['replies'])) {
        foreach ($comments['replies'] as $replies) {
            Request::render_comment(array('comments' => $replies, 'count' => $count + 1));
        }
    }
    ?>
</div>