<?php
namespace Controller;

use \Model\Author as AuthorModel;
use \Model\Model as Model;
use \Controller\Page as Page;

class Author {
    public function addAuthor() {
        $addAuthor = new AuthorModel;
        $page = new Page;
        $model = new Model;
        if(!isset($_POST['authorName']) || !isset($_POST['authorBirth'])) {
            $_SESSION['errors']['addAuthor']['general'] = 'Arrêtez de jouer avec le formulaire.';
            return ['view' => ['parts/admin.php']];
        }
        if($_POST['authorName'] === '') {
            $_SESSION['errors']['addAuthor']['name'] = 'Vous devez entrer un nom pour l’auteur';
        }

        if($_POST['authorBirth'] === '') {
            $_SESSION['errors']['addAuthor']['birth'] = 'Vous devez entrer une date de naissance pour l’auteur';
        }

        $authorImg = $model->checkField($_POST['authorImg']);
        $authorBio = $model->checkField($_POST['authorBio']);
        $authorDeath = $model->checkField($_POST['authorDeath']);

        if(!$addAuthor->getAuthor($_POST['authorName'], $_POST['authorBirth'])) {
            $addAuthor->addAuthor($_POST['authorName'], $_POST['authorBirth'], $authorImg, $authorBio, $authorDeath);
            return $page->getAdmin();
        } else {
            die('Cet auteur existe deja dans la base de données');
            $_SESSION['errors']['general'] = 'L’auteur entré existe déjà dans la base de données';
        }
    }
}