<div class="results__wrapper">
    <h2>Résultats pour la recherche pour le(s) terme(s)&nbsp;:
        <?php foreach($datas['search'] as $index => $term): if($term): ?>
        <span class="searchTerm"><?= $term; ?></span>
        <?php endif; endforeach; ?>
    </h2>
    <ul class="results__list">
        <?php
            if($_SESSION['bookResults']):
            foreach($_SESSION['bookResults'] as $book):
        ?>
        <li>
            <ul>
                <li>
                    <a href="index.php?bookId=<?= $book['bookId']; ?>&resource=Book&action=showBook">
                        <?= $book['title']; ?>
                    </a>
                </li>
                <li>
                    <?= $book['author']; ?>
                </li>
            </ul>
        </li>
        <?php endforeach; else: ?>
        <span class="results__empty">
            Il n’y a pas de livre qui correspond à vos critères de recherche.
        </span>
        <?php endif; ?>
    </ul>
    <a href="index.php?resource=Page&action=advancedSearch" class="results__link">Retourner à la page de recherche</a>
</div>