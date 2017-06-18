<h2>Panneau d'administration</h2>
<form action="index.php" method="post">
    <h3>Ajout d'un livre</h3>
    <?php if(isset($_SESSION['errors']['addBook']['general'])): ?>
        <span class="form-error"><?= $_SESSION['errors']['addBook']['general']; ?></span>
    <?php endif; ?>
    <?php if(isset($_SESSION['messages']['addBook']['general'])):
        $_SESSION['populate']['addBook'] = []; ?>
        <span class="form-success"><?= $_SESSION['messages']['addBook']['general']; ?></span>
    <?php endif; ?>

    <label for="bookTitle">Titre du livre</label>
    <input type="text" name="bookTitle" id="bookTitle" required="required" value="<?php if(isset($_SESSION['populate']['addBook']['bookTitle'])) echo $_SESSION['populate']['addBook']['bookTitle']; ?>">
    <?php if(isset($_SESSION['errors']['addBook']['title'])): ?>
        <span class="form-error"><?= $_SESSION['errors']['addBook']['title']; ?></span>
    <?php endif; ?>

    <label for="bookAuthor">Auteur</label>
    <select name="bookAuthor" id="bookAuthor" required="required">
        <?php foreach($datas['authors'] as $author): ?>
        <option <?php if(isset($_SESSION['populate']['addBook']['bookAuthor'])) {
            if($author['id'] === $_SESSION['populate']['addBook']['bookAuthor']) echo 'selected="selected"';
        }?> value="<?= $author['id']; ?>"><?= ucfirst($author['name']); ?></option>
        <?php endforeach; ?>
    </select>
    <?php if(isset($_SESSION['errors']['addBook']['author'])): ?>
        <span class="form-error"><?= $_SESSION['errors']['addBook']['author']; ?></span>
    <?php endif; ?>

    <label for="bookImg">Image jaquette</label>
    <input type="file" name="bookImg" id="bookImg">
    <?php if(isset($_SESSION['errors']['addBook']['cover'])): ?>
        <span class="form-error"><?= $_SESSION['errors']['addBook']['cover']; ?></span>
    <?php endif; ?>

    <label for="bookEditor">Éditeur</label>
    <input type="text" name="bookEditor" id="bookEditor" value="<?php if(isset($_SESSION['populate']['addBook']['bookEditor'])) echo $_SESSION['populate']['addBook']['bookEditor']; ?>">
    <?php if(isset($_SESSION['errors']['addBook']['editor'])): ?>
        <span class="form-error"><?= $_SESSION['errors']['addBook']['editor']; ?></span>
    <?php endif; ?>

    <label for="bookGenre">Genre</label>
    <select name="bookGenre" id="bookGenre" required="required">
        <?php foreach($datas['genres'] as $genre): ?>
            <option <?php if(isset($_SESSION['populate']['addBook']['bookGenre'])) {
                if($genre['id'] === $_SESSION['populate']['addBook']['bookGenre']) echo 'selected="selected"';
            }?> value="<?= $genre['id']; ?>"><?= ucfirst($genre['name']); ?></option>
        <?php endforeach; ?>
    </select>
    <?php if(isset($_SESSION['errors']['addBook']['genre'])): ?>
        <span class="form-error"><?= $_SESSION['errors']['addBook']['genre']; ?></span>
    <?php endif; ?>

    <label for="bookISBN">ISBN</label>
    <input type="text" name="bookISBN" id="bookISBN" required="required" value="<?php if(isset($_SESSION['populate']['addBook']['bookISBN'])) echo $_SESSION['populate']['addBook']['bookISBN']; ?>">
    <?php if(isset($_SESSION['errors']['addBook']['isbn'])): ?>
        <span class="form-error"><?= $_SESSION['errors']['addBook']['isbn']; ?></span>
    <?php endif; ?>

    <label for="bookPages">Nombre de pages</label>
    <input type="number" name="bookPages" id="bookPages" value="<?php if(isset($_SESSION['populate']['addBook']['bookPages'])) echo $_SESSION['populate']['addBook']['bookPages']; ?>">
    <?php if(isset($_SESSION['errors']['addBook']['pages'])): ?>
        <span class="form-error"><?= $_SESSION['errors']['addBook']['page']; ?></span>
    <?php endif; ?>

    <label for="bookDate">Date de publication (jj-mm-aaaa)</label>
    <input type="date" name="bookDate" id="bookDate" value="<?php if(isset($_SESSION['populate']['addBook']['bookDate'])) echo $_SESSION['populate']['addBook']['bookDate']; ?>">
    <?php if(isset($_SESSION['errors']['addBook']['date'])): ?>
        <span class="form-error"><?= $_SESSION['errors']['addBook']['date']; ?></span>
    <?php endif; ?>

    <label for="bookLanguage">Langue</label>
    <select name="bookLanguage" id="bookLanguage" required="required">
        <?php foreach($datas['languages'] as $language): ?>
            <option <?php if(isset($_SESSION['populate']['addBook']['bookLanguage'])) {
                if($language['id'] === $_SESSION['populate']['addBook']['bookLanguage']) echo 'selected="selected"';
            }?> value="<?= $language['id']; ?>"><?= ucfirst($language['name']); ?></option>
        <?php endforeach; ?>
    </select>
    <?php if(isset($_SESSION['errors']['addBook']['language'])): ?>
        <span class="form-error"><?= $_SESSION['errors']['addBook']['language']; ?></span>
    <?php endif; ?>

    <label for="bookSummary">Synopsis</label>
    <textarea name="bookSummary" id="bookSummary" cols="30" rows="10"><?php if(isset($_SESSION['populate']['addBook']['bookSummary'])) echo $_SESSION['populate']['addBook']['bookSummary']; ?></textarea>
    <?php if(isset($_SESSION['errors']['addBook']['summary'])): ?>
        <span class="form-error"><?= $_SESSION['errors']['addBook']['summary']; ?></span>
    <?php endif; ?>

    <input type="hidden" name="resource" value="Book">
    <input type="hidden" name="action" value="addBook">

    <button type="submit">Ajouter le livre</button>
</form>

<form action="index.php" method="post">
    <h3>Ajout d'un auteur</h3>

    <label for="authorName">Nom complet de l'auteur</label>
    <input type="text" id="authorName" name="authorName" required="required">

    <label for="authorBirth">Date de naissance</label>
    <input type="date" name="authorBirth" id="authorBirth" required="required">

    <label for="authorDeath">Date de décès</label>
    <input type="date" name="authorDeath" id="authorDeath">

    <label for="authorImg">Photo</label>
    <input type="file" name="authorImg" id="authorImg">

    <label for="authorBio">Bio</label>
    <textarea name="authorBio" id="authorBio" cols="30" rows="10"></textarea>

    <input type="hidden" name="resource" value="Author">
    <input type="hidden" name="action" value="addAuthor">

    <button type="submit">Ajouter l'auteur</button>
</form>

<?php $_SESSION['errors']['addBook'] = []; ?>
<?php $_SESSION['messages']['addBook'] = []; ?>
<?php $_SESSION['populate']['addBook'] = []; ?>
