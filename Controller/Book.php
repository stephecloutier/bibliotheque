<?php
namespace Controller;

use \Model\Book as BookModel;
use \Model\Model as Model;

class Book extends Page {
    public function search()
    {
        $bookModel = new BookModel;
        $_SESSION['bookResults'] = $bookModel->getResults($_GET['bookTitle']);
        return ['view' => ['parts/bookResults.php'], 'search' => [$_GET['bookTitle']]];
    }

    public function getAdvancedSearch()
    {
        $bookModel = new BookModel;
        $search = [$_GET['bookTitle'], $_GET['bookAuthor'], $_GET['bookGenre'], $_GET['bookLanguage']];
        $_SESSION['bookResults'] = $bookModel->getResults($_GET['bookTitle'], $_GET['bookAuthor'], $_GET['bookGenre'], $_GET['bookLanguage']);
        return ['view' => ['parts/bookResults.php'], 'search' => $search];
    }

    public function showBook()
    {
        $bookModel = new BookModel;
        $book = $bookModel->getSingleBook($_GET['bookId']);
        return ['view'=>['parts/single-book.php'], 'book'=>$book];
    }

    public function updateBook() {
        $bookModel = new BookModel;
        $model = new Model;

        $_SESSION['errors']['updateBook'] = []; // reset errors
        $_SESSION['messages']['updateBook'] = []; // reset messages

        if(!isset($_POST['bookTitle']) || !isset($_POST['bookAuthor']) || !isset($_POST['bookGenre']) || !isset($_POST['bookIsbn']) || !isset($_POST['bookLanguage']) || !isset($_POST['bookPages']) || !isset($_POST['bookDate']) || !isset($_POST['bookSummary'])) {
            $_SESSION['errors']['updateBook']['general'] = 'Arrêtez de jouer avec le formulaire.';
            header('Location: index.php?bookId=' . $_POST['bookId'] . '&resource=Page&action=bookUpdate');
            exit;
        }

        // Title control
        if($_POST['bookTitle'] === '') {
            $_SESSION['errors']['updateBook']['title'] = 'Vous devez obligatoirement entrer un titre pour le livre';
        }
        if(!$bookModel->checkInfoLength($_POST['bookTitle'])) {
            $_SESSION['errors']['updateBook']['title'] = 'Le titre du livre que vous avez entré est trop long';
        }

        // Author control
        if(!$bookModel->checkAuthor($_POST['bookAuthor'])) {
            $_SESSION['errors']['updateBook']['author'] = 'L’auteur que vous avez sélectionné n’est pas dans la base de données';
        }

        // Genre control
        if(!$bookModel->checkGenre($_POST['bookGenre'])) {
            $_SESSION['errors']['updateBook']['genre'] = 'Le genre que vous avez sélectionné n’est pas dans la base de données';
        }

        // ISBN control
        $bookIsbn = $bookModel->formatISBN($_POST['bookIsbn']);
        if($bookModel->checkISBN($bookIsbn) === 0) {
            $_SESSION['errors']['updateBook']['isbn'] = 'Le format de l’ISBN fourni n’est pas bon';
        }

        // Language control
        if(!$bookModel->checkLanguage($_POST['bookLanguage'])) {
            $_SESSION['errors']['updateBook']['language'] = 'La langue que vous avez sélectionné n’est pas dans la base de données';
        }

        // Setting to null potentially empty fields
        $bookPages = $model->checkField($_POST['bookPages']);
        $bookDate = $model->checkField($_POST['bookDate']);
        $bookSummary = $model->checkField($_POST['bookSummary']);

        // Date control
        if(!is_null($bookDate)) {
            if(!$model->validateDate($bookDate, 'Y-m-d')) {
                $_SESSION['errors']['updateBook']['date'] = 'Le format de la date n’est pas le bon. Merci de respecter un format aaaa-mm-jj';
            }
        }

        // Pages control
        if(!is_null($bookPages)) {
            if(!ctype_digit($bookPages)) {
                $_SESSION['errors']['updateBook']['pages'] = 'Vous devez entrer un nombre positif';
            }
        }

        // si erreurs, redirection pour leur affichage
        if(count($_SESSION['errors']['updateBook'])) {
            header('Location: index.php?bookId=' . $_POST['bookId'] . '&resource=Page&action=bookUpdate');
            exit;
        }

        // Updating the book
        $bookModel->updateBook($_POST['bookId'], $_POST['bookTitle'], $bookSummary, $bookIsbn, $bookPages, $bookDate, $_POST['bookLanguage'], $_POST['bookGenre'], $_POST['bookAuthor'], $_POST['authorBookId']);
        $_SESSION['messages']['updateBook']['general'] = 'Le livre :title a bien été modifié dans la base de données';
        header('Location: index.php?bookId=' . $_POST['bookId'] . '&resource=Page&action=bookUpdate');
        exit;
    }

    public function addBook() {
        $bookModel = new BookModel;
        $model = new Model;

        $_SESSION['errors']['addBook'] = []; // reset errors
        $_SESSION['messages']['addBook'] = []; // reset messages
        $_SESSION['populate']['addBook'] = $_POST; // repeupler les champs

        if(!isset($_POST['bookTitle']) || !isset($_POST['bookAuthor']) || !isset($_POST['bookGenre']) || !isset($_POST['bookISBN']) || !isset($_POST['bookLanguage']) || !isset($_POST['bookPages']) || !isset($_POST['bookDate']) || !isset($_POST['bookSummary'])) {
            $_SESSION['errors']['addBook']['general'] = 'Arrêtez de jouer avec le formulaire.';
            header('Location: index.php?resource=Page&action=getAdmin');
            exit;
        }

        // Title control
        if($_POST['bookTitle'] === '') {
            $_SESSION['errors']['addBook']['title'] = 'Vous devez obligatoirement entrer un titre pour le livre';
        }
        if(!$bookModel->checkInfoLength($_POST['bookTitle'])) {
            $_SESSION['errors']['addBook']['title'] = 'Le titre du livre que vous avez entré est trop long';
        }

        // Author control
        if(!$bookModel->checkAuthor($_POST['bookAuthor'])) {
            $_SESSION['errors']['addBook']['author'] = 'L’auteur que vous avez sélectionné n’est pas dans la base de données';
        }

        // Genre control
        if(!$bookModel->checkGenre($_POST['bookGenre'])) {
            $_SESSION['errors']['addBook']['genre'] = 'Le genre que vous avez sélectionné n’est pas dans la base de données';
        }

        // ISBN control
        $bookIsbn = $bookModel->formatISBN($_POST['bookISBN']);
        if($bookModel->checkISBN($bookIsbn) === 0) {
            $_SESSION['errors']['addBook']['isbn'] = 'Le format de l’ISBN fourni n’est pas bon';
        }

        // Language control
        if(!$bookModel->checkLanguage($_POST['bookLanguage'])) {
            $_SESSION['errors']['addBook']['language'] = 'La langue que vous avez sélectionné n’est pas dans la base de données';
        }

        // Setting to null potentially empty fields
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

        // si erreurs, redirection pour leur affichage
        if(count($_SESSION['errors']['addBook'])) {
            header('Location: index.php?resource=Page&action=getAdmin');
            exit;
        }

        // Checking if the book exists, if not, adding it.
        if(!$bookModel->getBook($bookIsbn)) {
            $bookModel->addBook($_POST['bookTitle'], $bookSummary, $bookIsbn, $bookPages, $bookDate, $_POST['bookLanguage'], $_POST['bookGenre'], $_POST['bookAuthor']);
            $_SESSION['messages']['addBook']['general'] = 'Le livre :title a bien été ajouté à la base de données';
            header('Location: index.php?resource=Page&action=getAdmin');
            exit;
        } else {
            $_SESSION['errors']['addBook']['general'] = 'Le livre existe déjà dans la base de données';
            header('Location: index.php?resource=Page&action=getAdmin');
            exit;
        }
    }
}