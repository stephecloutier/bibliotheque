<div class="single-book">
    <?php $book = $datas['book']; ?>

    <!-- conditionnels
    <img src="" alt="Couverture de <?= $book['title']; ?>">
    -->
    <form action="index.php" method="post">
        <h2>Modifier le livre <em><?= $book['title']; ?></em></h2>
        <?php if(isset($_SESSION['errors']['updateBook']['general'])): ?>
            <span class="form-error"><?= $_SESSION['errors']['updateBook']['general']; ?></span>
        <?php endif; ?>
        <?php if(isset($_SESSION['messages']['updateBook']['general'])): ?>
        <span class="form-success"><?= str_replace(':title', $book['title'], $_SESSION['messages']['updateBook']['general']); ?></span>
        <?php endif; ?>

        <label for="bookTitle">Titre *</label>
        <input type="text" id="bookTitle" name="bookTitle" value="<?= $book['title']; ?>" required="required">
        <?php if(isset($_SESSION['errors']['updateBook']['title'])): ?>
            <span class="form-error"><?= $_SESSION['errors']['updateBook']['title']; ?></span>
        <?php endif; ?>


        <label for="bookAuthor">Auteur *</label>
        <select name="bookAuthor" id="bookAuthor">
        <?php foreach($datas['authors'] as $author): ?>
            <option <?php if(isset($book['author'])) {
                if($author['id'] === $book['authorId']) echo 'selected="selected"';
            }?> value="<?= $author['id']; ?>"><?= ucfirst($author['name']); ?></option>
        <?php endforeach; ?>
        </select>
        <?php if(isset($_SESSION['errors']['updateBook']['author'])): ?>
            <span class="form-error"><?= $_SESSION['errors']['updateBook']['author']; ?></span>
        <?php endif; ?>

        <label for="bookGenre">Genre *</label>
        <select name="bookGenre" id="bookGenre" required="required">
            <?php foreach($datas['genres'] as $genre): ?>
                <option <?php if(isset($book['genre'])) {
                    if($genre['id'] === $book['genreId']) echo 'selected="selected"';
                }?> value="<?= $genre['id']; ?>"><?= ucfirst($genre['name']); ?></option>
            <?php endforeach; ?>
        </select>
        <?php if(isset($_SESSION['errors']['updateBook']['genre'])): ?>
            <span class="form-error"><?= $_SESSION['errors']['updateBook']['genre']; ?></span>
        <?php endif; ?>

        <label for="bookLanguage">Langue *</label>
        <select name="bookLanguage" id="bookLanguage" required="required">
            <?php foreach($datas['languages'] as $language): ?>
                <option <?php if(isset($book['language'])) {
                    if($language['id'] === $book['languageId']) echo 'selected="selected"';
                }?> value="<?= $language['id']; ?>"><?= ucfirst($language['name']); ?></option>
            <?php endforeach; ?>
        </select>
        <?php if(isset($_SESSION['errors']['updateBook']['language'])): ?>
            <span class="form-error"><?= $_SESSION['errors']['updateBook']['language']; ?></span>
        <?php endif; ?>

        <label for="bookIsbn">ISBN *</label>
        <input type="text" value="<?= $book['isbn']; ?>" id="bookIsbn" name="bookIsbn" required="required">
        <?php if(isset($_SESSION['errors']['updateBook']['isbn'])): ?>
            <span class="form-error"><?= $_SESSION['errors']['updateBook']['isbn']; ?></span>
        <?php endif; ?>


        <label for="bookDate">Date de parution (aaaa-mm-jj)</label>
        <input type="text" value="<?php if(isset($book['date'])) echo $book['date']; ?>" id="bookDate" name="bookDate">
        <?php if(isset($_SESSION['errors']['updateBook']['date'])): ?>
            <span class="form-error"><?= $_SESSION['errors']['updateBook']['date']; ?></span>
        <?php endif; ?>

        <label for="bookPages">Nombre de pages</label>
        <input type="text" value="<?php if(isset($book['npages'])) echo $book['npages']; ?>" id="bookPages" name="bookPages">
        <?php if(isset($_SESSION['errors']['updateBook']['pages'])): ?>
            <span class="form-error"><?= $_SESSION['errors']['updateBook']['pages']; ?></span>
        <?php endif; ?>

        <label for="bookSummary">Synopsis</label>
        <textarea id="bookSummary" name="bookSummary"><?php if(isset($book['summary'])) echo $book['summary']; ?></textarea>
        <?php if(isset($_SESSION['errors']['updateBook']['summary'])): ?>
            <span class="form-error"><?= $_SESSION['errors']['updateBook']['summary']; ?></span>
        <?php endif; ?>

        <input type="hidden" name="resource" value="Book">
        <input type="hidden" name="action" value="updateBook">
        <input type="hidden" name="bookId" value="<?= $book['bookId']; ?>">
        <input type="hidden" name="authorBookId" value="<?= $book['authorBookId']; ?>">

        <button type="submit">Modifier le livre</button>
    </form>

    <a href="index.php?bookId=<?= $book['bookId']; ?>&resource=Book&action=showBook">Retourner à la page du livre</a>

</div>
<?php
$_SESSION['errors']['updateBook'] = []; // reset errors
$_SESSION['messages']['updateBook'] = []; // reset messages
?>

