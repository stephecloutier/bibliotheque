<div class="single-book">
    <?php $book = $datas['book']; ?>

    <h2><?= $book['title']; ?></h2>
    <?php if(isset($_SESSION['user']) && intval($_SESSION['user']['status']) === 1): ?>
        <a class="modify__link" href="index.php?bookId=<?= $book['bookId']; ?>&resource=Page&action=bookUpdate">Modifier le livre</a>

        <form class="form_nostyle" action="index.php" method="post">
            <input type="hidden" name="resource" value="Book">
            <input type="hidden" name="action" value="deleteBook">
            <input type="hidden" name="bookId" value="<?= $book['bookId']; ?>">
            <button type="submit" class="delete__link">Supprimer le livre</button>
        </form>
    <?php endif; ?>

    <dl>
        <dt>Auteur</dt>
        <dd>
            <a href="">
                <?= $book['author']; ?>
            </a>
        </dd>

        <dt>Genre</dt>
        <dd>
            <?= $book['genre']; ?>
        </dd>

        <dt>Langue</dt>
        <dd>
            <?= $book['language']; ?>
        </dd>

        <dt>ISBN</dt>
        <dd>
            <?= $book['isbn']; ?>
        </dd>

        <!-- conditionnels -->
        <?php if($book['date']): ?>
        <dt>Date de parution</dt>
        <dd><time datetime="<?= $book['date']; ?>"><?= $book['date']; ?></time></dd>
        <?php endif; ?>

        <?php if($book['npages']): ?>
        <dt>Nombre de pages</dt>
        <dd><?= $book['npages']; ?></dd>
        <?php endif; ?>

        <?php if($book['summary']): ?>
        <dt>Synopsis</dt>
        <dd><p><?= $book['summary']; ?></p></dd>
        <?php endif; ?>
        <!-- / -->

    </dl>
    <!-- à faire
    <a href="">Retourner aux résultats de recherche</a>-->

</div>