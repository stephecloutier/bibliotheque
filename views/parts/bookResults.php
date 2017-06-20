<div class="results__wrapper">
    <ul class="results__list">
        <?php
            if($_SESSION['bookResults']):
            foreach($_SESSION['bookResults'] as $book):
        ?>
        <li>
            <ul>
                <li>
                   <?= $book['title']; ?>
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