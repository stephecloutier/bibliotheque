<form class="search" action="index.php" method="get">
    <label for="search">Rechercher un livre <span>par son titre</span></label>
    <input type="text" id="search" name="bookTitle">

    <input type="hidden" name="resource" value="Book">
    <input type="hidden" name="action" value="search">

    <button type="submit">Rechercher</button>
</form>
<a href="index.php?resource=Page&action=advancedSearch" title="Aller sur la page de recherche avancée">Recherche avancée</a>