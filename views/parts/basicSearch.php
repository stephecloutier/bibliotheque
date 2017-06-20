<form class="search" action="index.php" method="get">
    <h2>Rechercher un livre <span>par son titre</span></h2>

    <label for="search">Titre du livre</label>
    <input type="text" id="search" name="bookTitle">

    <input type="hidden" name="resource" value="Book">
    <input type="hidden" name="action" value="search">

    <button type="submit">Rechercher</button>
</form>
<a class="search__link" href="index.php?resource=Page&action=advancedSearch" title="Aller sur la page de recherche avancée">Recherche avancée</a>