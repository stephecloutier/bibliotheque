<form class="search" action="index.php" method="GET">
    <h2>Recherche avancée</h2>

    <label for="title">Titre</label>
    <input type="text" name="bookTitle" id="title">

    <label for="author">Auteur</label>
    <input type="text" name="bookAuthor" id="author">

    <label for="genre">Genre</label>
    <select name="bookGenre" id="genre">

        <option selected="selected" value="">Ne pas rechercher par genre</option>
        <?php foreach($datas['genres'] as $genre): ?>
            <option value="<?= $genre['id']; ?>"><?= ucfirst($genre['name']); ?></option>
        <?php endforeach; ?>
    </select>

    <label for="language">Langue</label>
    <select name="bookLanguage" id="language">
        <option selected="selected" value="">Ne pas rechercher par langue</option>
        <?php foreach($datas['languages'] as $language): ?>
            <option value="<?= $language['id']; ?>"><?= ucfirst($language['name']); ?></option>
        <?php endforeach; ?>
    </select>

    <input type="hidden" name="resource" value="Book">
    <input type="hidden" name="action" value="getAdvancedSearch">

    <button type="submit">Rechercher</button>
</form>