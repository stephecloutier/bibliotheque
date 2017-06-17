<?php
namespace Controller;

use \Model\BookCreation as BookCreationModel;

class BookCreation {
    public function addBook() {
        $createBook = new BookCreationModel;
        $createBook->addBookCover($_FILES['bookImg'], $_FILES['bookTitle']);
    }

    public function addAuthor() {
        $addAuthor = new BookCreationModel;
        $addAuthor->getAuthor($_POST['authorName']);
    }
}