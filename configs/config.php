<?php
define('INI_FILE', 'configs/db.ini');
define('LOCAL_PATH', 'homestead.app/pwcs/bibliotheque/');

$navItems = [
    'home' => ['label' => 'Accueil', 'url' => 'index.php'] ,
    'register' => ['label' => 'S’inscrire', 'url' => 'index.php?resource=Page&action=getRegistration'],
    'login' => ['label' => 'Se connecter', 'url' => 'index.php?resource=Page&action=getLogin'],
    'news' => ['label' => 'Nouveautés', 'url' => 'index.php?resource=Page&action=news'],
    'search' => ['label' => 'Recherche', 'url' => 'index.php?resource=Page&action=getSearch'],
    'profile' => ['label' => 'Mon profil', 'url' => 'index.php?resource=Page&action=getProfile'],
    'suggestions' => ['label' => 'Suggestions', 'url' => 'index.php?resource=Page&action=suggestions'],
    'logout' => ['label' => 'Se déconnecter', 'url' => 'index.php?resource=Page&action=logout'],
    'about' => ['label' => 'À propos', 'url' => 'index.php?resource=Page&action=about'],
];

$loginNavItems = ['home', 'profile', 'news', 'suggestions', 'search', 'about', 'logout'];
$logoutNavItems = ['home', 'news', 'search', 'about', 'register', 'login'];