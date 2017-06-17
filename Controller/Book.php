<?php
namespace Controller;

use \Model\Book as BookModel;

class Book {
    public function addBook() {
        $createBook = new BookModel;
        $createBook->addBookCover($_FILES['bookImg'], $_FILES['bookTitle']);
    }
}