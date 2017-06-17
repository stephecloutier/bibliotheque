<?php
namespace Controller;

use \Model\Book as BookModel;
use \Model\Model as Model;
use \Controller\Page as Page;

class Book {
    public function addBook() {
        $createBook = new BookModel;
        $page = new Page;
        $model = new Model;
        if(!isset($_POST['bookTitle']) || !isset($_POST['bookAuthor']) || !isset($_POST['bookGenre']) || !isset($_POST['bookISBN']) || !isset($_POST['bookLanguage'])) {
            die('Vous devez remplir tous les champs obligatoires');
        }

        $bookIsbn = $createBook->formatISBN($_POST['bookISBN']);
        if($createBook->checkISBN($bookIsbn) === 0) {
            die('Le format de l’ISBN fourni n’est pas bon.');
        }
        if(!isset($_FILES['bookImg']))  {
            $bookImg = null;
        }
        $bookEditor = $model->checkField($_POST['bookEditor']);
        $bookPages = $model->checkField($_POST['bookPages']);
        $bookDate = $model->checkField($_POST['bookDate']);
        $bookSummary = $model->checkField($_POST['bookSummary']);

        if(!$createBook->getBook($_POST['bookISBN'])) {
            $createBook->addBook($_POST['bookTitle'], $bookImg, $bookSummary, $_POST['bookISBN'], $bookPages, $bookDate, $_POST['bookLanguage'], $_POST['bookGenre'], $bookEditor, $_POST['bookAuthor']);
            return $page->getAdmin();
        } else {
            die('Le livre existe déjà dans la base de données');
        }
        //$createBook->addBookCover($_FILES['bookImg'], $_FILES['bookTitle']);
    }
}