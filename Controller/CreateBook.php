<?php
namespace Controller;

use \Model\CreateBook as CreateBookModel;

class CreateBook {
    public function addBook() {
        $createBook = new CreateBookModel;
        $createBook->addBookCover($_FILES['bookImg'], $_FILES['bookTitle']);
    }
}