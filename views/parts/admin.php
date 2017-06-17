<h2>Panneau d'administration</h2>
<form action="index.php" method="post">
    <h3>Ajout d'un livre</h3>

    <label for="title">Titre du livre</label>
    <input type="text" name="bookTitle" id="title">

    <label for="author">Auteur</label>
    <select name="bookAuthor" id="author">
        <option value="1">Nom d'un auteur</option>
    </select>

    <label for="img">Image jaquette</label>
    <input type="image" name="bookImg" id="img">

    <label for="editor">Éditeur</label>
    <input type="text" name="bookEditor" id="editor">

    <label for="genre">Genre</label>
    <select name="bookGenre" id="genre">
        <option value="1">Fantastique</option>
    </select>

    <label for="isbn">ISBN</label>
    <input type="text" name="bookISBN" id="isbn">

    <label for="pages">Nombre de pages</label>
    <input type="number" name="bookPages" id="pages">

    <label for="date">Date de publication</label>
    <input type="date" name="bookDate" id="date">

    <label for="language">Langue</label>
    <select name="bookLanguage" id="language">
        <option value="1">Français</option>
        <option value="2">Anglais</option>
    </select>

    <label for="summary">Synopsis</label>
    <textarea name="bookSummary" id="summary" cols="30" rows="10"></textarea>

    <input type="hidden" name="resource" value="CreateBook">
    <input type="hidden" name="action" value="addBook">

    <button type="submit">Ajouter le livre</button>
</form>

<form action="index.php" method="post">
    <h3>Ajout d'un auteur</h3>

    <label for="name">Nom complet de l'auteur</label>
    <input type="text" id="name" name="authorName">
</form>