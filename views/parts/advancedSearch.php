<form action="index.php" method="GET">
    <h2>Rechercher un livre</h2>

    <label for="title">Titre</label>
    <input type="text" name="bookTitle" id="title">
    <label for="author">Auteur</label>
    <input type="text" name="bookAuthor" id="author">
    <label for="editor">Éditeur</label>
    <input type="text" name="bookEditor" id="editor">
    <label for="genre">Genre</label>
    <select name="bookGenre" id="genre">
        <option value="À boucler en php"></option>
    </select>
    <label for="language">Langue</label>
    <select name="bookLanguage" id="language">
        <option value="À boucler en php"></option>
    </select>
    <button type="submit">Rechercher</button>
</form>