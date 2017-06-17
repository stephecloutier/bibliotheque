<nav>
    <ul class="navigation__list">
        <li class="navigation__item">
            <a href="index.php" class="navigation__link">Accueil</a>
        </li>
        <li class="navigation__item">
            <a href="index.php?resource=Page&action=getProfile" class="navigation__link">Mon profil</a>
        </li>
        <li class="navigation__item">
            <a href="index.php?resource=Page&action=news" class="navigation__link">Nouveautés</a>
        </li>
        <li class="navigation__item">
            <a href="index.php?resource=Page&action=suggestions" class="navigation__link">Suggestions</a>
        </li>
        <li class="navigation__item">
            <a href="index.php?resource=Page&action=getSearch" class="navigation__link">Recherche</a>
        </li>
        <li class="navigation__item">
            <a href="index.php?resource=Page&action=about" class="navigation__link">À propos</a>
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