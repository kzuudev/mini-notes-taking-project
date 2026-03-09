<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <?php foreach ($notes as $note) : ?>
            <ul>
               <li>
                    <a href="note?id=<?= $note['id'] ?> ">
                        <?= $note['title'] ?>
                    </a>
               </li>
            </ul>
        <?php endforeach; ?>
    </div>
</main>

<?php require('partials/footer.php') ?>