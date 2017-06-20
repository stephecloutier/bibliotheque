<nav class="navigation">
    <ul class="navigation__list">
        <li class="navigation__item">
            <a href="index.php" class="navigation__link">Accueil</a>
        </li>
        <!-- À ajouter lors d'une amélioration de mon projet
        <li class="navigation__item">
            <a href="index.php?resource=Page&action=getProfile" class="navigation__link">Mon profil</a>
        </li>
        <li class="navigation__item">
            <a href="index.php?resource=Page&action=news" class="navigation__link">Nouveautés</a>
        </li>
        <li class="navigation__item">
            <a href="index.php?resource=Page&action=suggestions" class="navigation__link">Suggestions</a>
        </li>
        -->
        <li class="navigation__item">
            <a href="index.php?resource=Page&action=advancedSearch" class="navigation__link">Recherche avancée</a>
        </li>
        <?php if(intval($_SESSION['user']['status']) === 1): ?>
        <li class="navigation__item">
            <a href="index.php?resource=Page&action=getAdmin" class="navigation__link">Panneau d'administrateur</a>
        </li>
        <?php endif; ?>
        <li class="navigation__item">
            <a href="index.php?resource=Auth&action=getLogout" class="navigation__link">Se déconnecter</a>
        </li>
    </ul>
</nav>