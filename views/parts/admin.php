<h2>Panneau d'administration</h2>
<form action="index.php" method="post">
    <h3>Ajout d'un livre</h3>

    <label for="bookTitle">Titre du livre</label>
    <input type="text" name="bookTitle" id="bookTitle" required="required">

    <label for="bookAuthor">Auteur</label>
    <select name="bookAuthor" id="bookAuthor" required="required">
        <?php foreach($datas['authors'] as $author): ?>
        <option value="<?= $author['id']; ?>"><?= ucfirst($author['name']); ?></option>
        <?php endforeach; ?>
    </select>

    <label for="bookImg">Image jaquette</label>
    <input type="file" name="bookImg" id="bookImg">

    <label for="bookEditor">Éditeur</label>
    <input type="text" name="bookEditor" id="bookEditor">

    <label for="bookGenre">Genre</label>
    <select name="bookGenre" id="bookGenre" required="required">
        <?php foreach($datas['genres'] as $genre): ?>
            <option value="<?= $genre['id']; ?>"><?= ucfirst($genre['name']); ?></option>
        <?php endforeach; ?>
    </select>

    <label for="bookISBN">ISBN</label>
    <input type="text" name="bookISBN" id="bookISBN" required="required">

    <label for="bookPages">Nombre de pages</label>
    <input type="number" name="bookPages" id="bookPages">

    <label for="bookDate">Date de publication</label>
    <input type="date" name="bookDate" id="bookDate">

    <label for="bookLanguage">Langue</label>
    <select name="bookLanguage" id="bookLanguage" required="required">
        <?php foreach($datas['languages'] as $language): ?>
            <option value="<?= $language['id']; ?>"><?= ucfirst($language['name']); ?></option>
        <?php endforeach; ?>
    </select>

    <label for="bookSummary">Synopsis</label>
    <textarea name="bookSummary" id="bookSummary" cols="30" rows="10"></textarea>

    <input type="hidden" name="resource" value="BookCreation">
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