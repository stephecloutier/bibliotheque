<div class="results__wrapper">
    <ul class="results__list">
        <?php foreach($_SESSION['bookResults'] as $book): ?>
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
        <?php endforeach; ?>
    </ul>
</div>