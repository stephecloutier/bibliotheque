<?php
namespace Model;

class Book extends Model {

    public function getBook($isbn)
    {
        $pdo = $this->connectDB();
        if($pdo) {
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $pdoSt = $pdo->prepare('SELECT * FROM books WHERE isbn = :isbn');
            $pdoSt->bindValue(':isbn', $isbn);
            try {
                $pdoSt->execute();
                return $pdoSt->fetch();
            } catch(\PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
        }
    }

    public function addBook($bookTitle, $bookCover, $bookSummary, $bookIsbn, $bookPages, $bookDate, $bookLanguage, $bookGenre, $bookEditor, $bookAuthor)
    {
        $pdo = $this->connectDB();
        if($pdo) {
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $pdoSt = $pdo->prepare('INSERT INTO books(title, front_cover, summary, isbn, npages, datepub, language_id, genre_id, editor_id) VALUES(:bookTitle, :bookCover, :bookSummary, :bookIsbn, :bookPages, :bookDate, :bookLanguage, :bookGenre, :bookEditor)');
            $pdoSt->bindValue(':bookTitle', $bookTitle);
            $pdoSt->bindValue(':bookCover', $bookCover);
            $pdoSt->bindValue(':bookSummary', $bookSummary);
            $pdoSt->bindValue(':bookIsbn', $bookIsbn);
            $pdoSt->bindValue(':bookPages', $bookPages);
            $pdoSt->bindValue(':bookDate', $bookDate);
            $pdoSt->bindValue(':bookLanguage', $bookLanguage);
            $pdoSt->bindValue(':bookGenre', $bookGenre);
            $pdoSt->bindValue(':bookEditor', $bookEditor);
            try {
                $pdoSt->execute();
            } catch(\PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
            $pdoSt = $pdo->prepare('INSERT INTO author_book(author_id, book_id) VALUES(:authorId, :bookId)');
            $pdoSt->bindValue(':bookId', $pdo->lastInsertId());
            $pdoSt->bindValue(':authorId', $bookAuthor);
            var_dump($bookAuthor);
            try {
                $pdoSt->execute();
            } catch(\PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
        }
    }

    public function formatISBN($isbn)
    {
        return preg_replace('/[^0-9]/', '', $isbn);
    }

    public function checkISBN($isbn)
    {
        return preg_match('/^(97(8|9))?\d{9}(\d|X)$/', $isbn);
    }

    public function addBookCover($file, $filename)
    {
        $feedback = '';
        if(!isset($file)) {
            return ['error' => 'Il y a eu une erreur lors de l’envoi de l’image'];
        }
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if(!in_array($file['type'], $allowedTypes)) {
            return ['error' => 'Le fichier envoyé n’est pas un jpeg ou un png'];
        }
        //$typeParts = explode('/', $file['type']);
        //$ext = '.' . $typeParts[count($typeParts) - 1];
        iconv($charset, 'ASCII//TRANSLIT//IGNORE', $str);
        $filename = str_replace([' ', '\''], '-', $filename);
        $dest = './files/' . $filename;
        // return url
    }
}