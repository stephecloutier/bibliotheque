<?php
namespace Controller;

use \Model\Author as AuthorModel;
use \Model\Model as Model;

class Author {
    public function addAuthor() {
        $addAuthor = new AuthorModel;
        $model = new Model;

        $_SESSION['errors']['addAuthor'] = []; // reset errors
        $_SESSION['messages']['addAuthor'] = []; // reset messages
        $_SESSION['populate']['addAuthor'] = $_POST; // repeupler les champs


        if(!isset($_POST['authorName']) || !isset($_POST['authorBirth'])) {
            $_SESSION['errors']['addAuthor']['general'] = 'Arrêtez de jouer avec le formulaire.';
            header('Location: index.php?resource=Page&action=getAdmin');
            exit;
        }

        // Check name
        if($_POST['authorName'] === '') {
            $_SESSION['errors']['addAuthor']['name'] = 'Vous devez entrer un nom pour l’auteur';
        }

        // Check birth date
        $authorBirth = $_POST['authorBirth'];
        if($authorBirth === '') {
            $_SESSION['errors']['addAuthor']['birth'] = 'Vous devez entrer une date de naissance pour l’auteur';
        } else {
            if(!$model->validateDate($authorBirth)) {
                $_SESSION['errors']['addAuthor']['birthDate'] = 'Le format de la date n’est pas le bon. Merci de respecter un format jj-mm-aaaa';
            } else {
                $authorBirth = explode('-', $_POST['authorBirth']);
                $authorBirth = implode('-', [$authorBirth[2], $authorBirth[1], $authorBirth[0]]);
            }
        }

        // unrequired fields are set to null if empty
        $authorImg = $model->checkField($_POST['authorImg']);
        $authorBio = $model->checkField($_POST['authorBio']);
        $authorDeath = $model->checkField($_POST['authorDeath']);

        // check cover
        //todo

        // check death date
        if(!is_null($authorDeath)) {
            if(!$model->validateDate($authorDeath)) {
                $_SESSION['errors']['addAuthor']['deathDate'] = 'Le format de la date n’est pas le bon. Merci de respecter un format jj-mm-aaaa';
            } else {
                $authorDeath = explode('-', $authorDeath);
                $authorDeath = implode('-', [$authorDeath[2], $authorDeath[1], $authorDeath[0]]);
            }
        }

        // si erreurs, redirection pour leur affichage
        if(count($_SESSION['errors']['addAuthor'])) {
            header('Location: index.php?resource=Page&action=getAdmin');
            exit;
        }

        if(!$addAuthor->getAuthor($_POST['authorName'], $authorBirth)) {
            $addAuthor->addAuthor($_POST['authorName'], $authorBirth, $authorImg, $authorBio, $authorDeath);
            $_SESSION['messages']['addAuthor']['general'] = 'L’auteur :name a bien été ajouté à la base de données';
            header('Location: index.php?resource=Page&action=getAdmin');
            exit;
        } else {
            $_SESSION['errors']['addAuthor']['general'] = 'L’auteur entré existe déjà dans la base de données';
            header('Location: index.php?resource=Page&action=getAdmin');
            exit;
        }
    }
}