<?php
namespace Controller;

use \Model\Book as BookModel;
use \Model\Model as Model;

class Book extends Page {
    public function addBook() {
        $createBook = new BookModel;
        $page = new Page;
        $model = new Model;
        if(!isset($_POST['bookTitle']) || !isset($_POST['bookAuthor']) || !isset($_POST['bookGenre']) || !isset($_POST['bookISBN']) || !isset($_POST['bookLanguage'])) {
            $_SESSION['errors']['addBook']['general'] = 'Arrêtez de jouer avec le formulaire.';
            return ['view' => ['parts/admin.php']];
        }

        // Title control
        if($_POST['bookTitle'] === '') {
            $_SESSION['errors']['addBook']['title'] = 'Vous devez obligatoirement entrer un titre pour le livre';
        }
        if(!$createBook->checkInfoLength($_POST['bookTitle'])) {
            die('Le titre du livre que vous avez entré est trop long');
            $_SESSION['errors']['addBook']['title'] = 'Le titre du livre que vous avez entré est trop long';
        }

        // Author control
        if($_POST['bookAuthor'] === '') {
            $_SESSION['errors']['addBook']['author'] = 'Vous devez obligatoirement choisir un auteur pour le livre';
        }

        // Genre control
        if($_POST['bookGenre'] === '') {
            $_SESSION['errors']['addBook']['genre'] = 'Vous devez obligatoirement choisir un genre pour le livre';
        }

        // ISBN control
        if($_POST['bookIsbn'] === '') {
            $_SESSION['errors']['addBook']['isbn'] = 'Vous devez obligatoirement entrer un isbn pour le livre';
        }
        $bookIsbn = $createBook->formatISBN($_POST['bookISBN']);
        if($createBook->checkISBN($bookIsbn) === 0) {
            $_SESSION['errors']['addBook']['isbn'] = 'Le format de l’ISBN fourni n’est pas bon';
        }

        // Language control
        if($_POST['bookLanguage'] === '') {
            $_SESSION['errors']['addBook']['language'] = 'Vous devez obligatoirement choisir une langue pour le livre';
        }

        // Cover control
        if(!isset($_FILES['bookImg']))  {
            $bookImg = null;
        } else {
            $bookImg = null; // à changer
        }

        // Setting to null empty fields
        $bookEditor = $model->checkField($_POST['bookEditor']);
        $bookPages = $model->checkField($_POST['bookPages']);
        $bookDate = $model->checkField($_POST['bookDate']);
        $bookSummary = $model->checkField($_POST['bookSummary']);

        // Checking if the book exists, if not, adding it.
        if(!$createBook->getBook($bookIsbn)) {
            $createBook->addBook($_POST['bookTitle'], $bookImg, $bookSummary, $bookIsbn, $bookPages, $bookDate, $_POST['bookLanguage'], $_POST['bookGenre'], $bookEditor, $_POST['bookAuthor']);
            return $this->getAdmin();
        } else {
            die('Le livre existe déjà dans la base de données');
            $_SESSION['errors']['addBook']['general'] = 'Le livre existe déjà dans la base de données';
        }
        //$createBook->addBookCover($_FILES['bookImg'], $_FILES['bookTitle']);
    }
}