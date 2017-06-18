<?php
namespace Controller;

use \Model\Book as BookModel;
use \Model\Model as Model;

class Book extends Page {
    public function addBook() {
        $createBook = new BookModel;
        $model = new Model;

        $_SESSION['errors']['addBook'] = []; // reset errors

        if(!isset($_POST['bookTitle']) || !isset($_POST['bookAuthor']) || !isset($_POST['bookGenre']) || !isset($_POST['bookISBN']) || !isset($_POST['bookLanguage'])) {
            $_SESSION['errors']['addBook']['general'] = 'Arrêtez de jouer avec le formulaire.';
            header('Location: index.php?resource=Page&action=getAdmin');
        }

        // Title control
        if($_POST['bookTitle'] === '') {
            $_SESSION['errors']['addBook']['title'] = 'Vous devez obligatoirement entrer un titre pour le livre';
        }
        if(!$createBook->checkInfoLength($_POST['bookTitle'])) {
            $_SESSION['errors']['addBook']['title'] = 'Le titre du livre que vous avez entré est trop long';
        }

        // Author control
        if(!$createBook->checkAuthor($_POST['bookAuthor'])) {
            $_SESSION['errors']['addBook']['author'] = 'L’auteur que vous avez sélectionné n’est pas dans la base de données';
        }

        // Genre control
        if(!$createBook->checkGenre($_POST['bookGenre'])) {
            $_SESSION['errors']['addBook']['genre'] = 'Le genre que vous avez sélectionné n’est pas dans la base de données';
        }

        // ISBN control
        $bookIsbn = $createBook->formatISBN($_POST['bookISBN']);
        if($createBook->checkISBN($bookIsbn) === 0) {
            $_SESSION['errors']['addBook']['isbn'] = 'Le format de l’ISBN fourni n’est pas bon';
        }

        // Language control
        if(!$createBook->checkLanguage($_POST['bookLanguage'])) {
            $_SESSION['errors']['addBook']['language'] = 'La langue que vous avez sélectionné n’est pas dans la base de données';
        }

        // Setting to null potentially empty fields
        $bookEditor = $model->checkField($_POST['bookEditor']);
        $bookPages = $model->checkField($_POST['bookPages']);
        $bookDate = $model->checkField($_POST['bookDate']);
        $bookSummary = $model->checkField($_POST['bookSummary']);

        // Date control
        if(!is_null($bookDate)) {
            if(!$model->validateDate($bookDate)) {
                $_SESSION['errors']['addBook']['date'] = 'Le format de la date n’est pas le bon. Merci de respecter un format jj-mm-aaaa';
            } else {
                $bookDate = explode('-', $bookDate);
                $bookDate = implode('-', [$bookDate[2], $bookDate[1], $bookDate[0]]);
            }
        }

        // Pages control
        if(!is_null($bookPages)) {
            if(!ctype_digit($bookPages)) {
                $_SESSION['errors']['addBook']['pages'] = 'Vous devez entrer un nombre positif';
            }
        }

        // Cover control
        if(!isset($_FILES['bookImg']))  {
            $bookImg = null;
        } else {
            $bookImg = null; // à changer
        }

        // si erreurs, redirection pour leur affichage
        if(count($_SESSION['errors']['addBook'])) {
            header('Location: index.php?resource=Page&action=getAdmin');
        }

        // Checking if the book exists, if not, adding it.
        if(!$createBook->getBook($bookIsbn)) {
            $createBook->addBook($_POST['bookTitle'], $bookImg, $bookSummary, $bookIsbn, $bookPages, $bookDate, $_POST['bookLanguage'], $_POST['bookGenre'], $bookEditor, $_POST['bookAuthor']);
            $_SESSION['messages']['addBook']['general'] = 'Le livre a bien été ajouté à la base de données';
            header('Location: index.php?resource=Page&action=getAdmin');
        } else {
            $_SESSION['errors']['addBook']['general'] = 'Le livre existe déjà dans la base de données';
            header('Location: index.php?resource=Page&action=getAdmin');
        }
        //$createBook->addBookCover($_FILES['bookImg'], $_FILES['bookTitle']);
    }
}