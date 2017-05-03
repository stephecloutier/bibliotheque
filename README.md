# Bibliothèque

Le but du projet est de créer une application de gestion de bibliothèque avec les emprunts de livres des utilisateurs.

## Fonctions principales
* Recherche de base (Prend en compte titre, auteur)
* Recherche avancée (Titre, auteur, genre, langue, éditeur)
    * Possibilité de trier par note
* Connexion de l'utilisateur
    * Personnalisation du profil
* Visualiser les emprunts d'un utilisateur (sans la possibilité de les faire via l'application)
    * Voir les livres qui seraient en retard
* Visualiser des fiches de livres individuels avec leur cote
    * Possibilité de voir s'ils sont en stock ou non
    * De là, pouvoir accéder à la page de leur auteur
        * Voir les livres écrits par l'auteur, par ordre de popularité
* Ajouter une note et un commentaire à un livre individuel
    * Et voir les commentaires présents sur ce livre
* Ajout de livres aux favoris
    * Visualiser des suggestions de livres en fonctions des livres mis en favoris
* Visualiser les nouveautés arrivées à la bibliothèque

---

## Pages

### Accueil (non-connecté)
* Recherche de base
    * Accès à la recherche avancée
* Nouveautés de la bibliothèque
* Menu
    * Connexion
    * Inscription
    * Nouveautés
    * Recherche (avancée)

### Accueil (connecté)
* Recherche de base
    * Accès à la recherche avancée
* Suggestions
* Nouveautés de la bibliothèque
* Menu
    * Mon profil
    * Nouveautés
    * Suggestions
    * Recherche (avancée)

### Recherche (avancée)
* Titre
* auteur
* éditeur
* genre (select)
* langue (select)

(Redirection vers Résultats de recherche)

### Résultats de recherche
* 10 / 20 / 30 / ...  résultats
    * Possibilité de trier par note
* Possibilité d'affichage avec ou sans vignette du livre

### Connexion
* Champ username
* Champ password
* Lien vers la page d'inscription

(Redirection vers l'Accueil)

### Inscription
* Champ username
* Champ email
* Champ password + confirmation
* Lien vers la page de connexion

(Redirection vers Mon profil)

### Mon profil
* Avatar (modifiable)
* username (non-modifiable)
* email (modifiable)
* Liste des emprunts (10 max.)
    * Information visuelle sur les retards
    * Affichage constant de la date de retour
    * Tri par ordre croissant de date de retour (plus tôt au plus tard)
* Liste des favoris
    * Possibilité de supprimer (avec confirmation) un favoris

### Nouveautés
* Affichage des 10 dernières nouveautés de la bibliothèque
    * Affichage avec ou sans vignette du livre

### Suggestions
* Affichage de 10 / 20 / 30 / ... suggestions
    * En fonction des livres en favoris (Genre et auteur)
    * Affichage avec ou sans vignette du livre

### Livre individuel (par ISBN)
* Titre
* Vignette du livre
* Disponibilité
* Ajout aux favoris
* Cote (localisation dans bibliothèque)
* Infos
    * Date de parution
    * Genre
    * Éditions
    * langue
    * ISBN
    * Auteur (Lien vers la page de l'auteur)
* Résumé
* Section d'avis
    * Visualiser les 3 avis les plus récents
    * Possibilité de voir tous les avis
    * Possibilité de donner un avis
        * Note + commentaire

### Page d'avis d'un livre
* Liste des avis
    * Possibilité de trier par note / date (Par défaut : date)
* Affichage du username, date, note et commentaire

### Page d'auteur
* Nom
* Photo
* Date de naissance
* Genre (Liste des 3(max) genres les plus écrits)
* Courte bio
* Liste des livres (triés par notes)
    * Accès aux pages de livres individuels
