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
                $_SESSION['errors']['BDD'] = 'Il y a eu une erreur lors de la connexion à la base de données';
            }
        }
    }

    public function getSingleBook($id)
    {
        $pdo = $this->connectDB();
        if($pdo) {
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $pdoSt = $pdo->prepare('SELECT books.title AS title, 
                                    books.id AS bookId, 
                                    books.isbn AS isbn, 
                                    books.datepub AS date, 
                                    books.npages AS npages, 
                                    books.summary AS summary, 
                                    authors.name AS author, 
                                    authors.id AS authorId, 
                                    languages.name AS language, 
                                    languages.id AS languageId, 
                                    genres.name AS genre, 
                                    genres.id AS genreId, 
                                    ab.id AS authorBookId 
                                    FROM books 
                                    JOIN author_book ab ON books.id = ab.book_id 
                                    JOIN authors ON ab.author_id = authors.id 
                                    JOIN languages ON books.language_id = languages.id 
                                    JOIN genres ON books.genre_id = genres.id 
                                    WHERE books.id = :id');
            $pdoSt->bindValue(':id', $id);
            try {
                $pdoSt->execute();
                return $pdoSt->fetch();
            } catch(\PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
                $_SESSION['errors']['BDD'] = 'Il y a eu une erreur lors de la connexion à la base de données';
            }
        }
    }

    public function addBook($bookTitle, $bookSummary, $bookIsbn, $bookPages, $bookDate, $bookLanguage, $bookGenre, $bookAuthor)
    {
        $pdo = $this->connectDB();
        if($pdo) {
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $pdoSt = $pdo->prepare('INSERT INTO books(title, summary, isbn, npages, datepub, language_id, genre_id) VALUES(:bookTitle, :bookSummary, :bookIsbn, :bookPages, :bookDate, :bookLanguage, :bookGenre)');
            $pdoSt->bindValue(':bookTitle', $bookTitle);
            $pdoSt->bindValue(':bookSummary', $bookSummary);
            $pdoSt->bindValue(':bookIsbn', $bookIsbn);
            $pdoSt->bindValue(':bookPages', $bookPages);
            $pdoSt->bindValue(':bookDate', $bookDate);
            $pdoSt->bindValue(':bookLanguage', $bookLanguage);
            $pdoSt->bindValue(':bookGenre', $bookGenre);
            try {
                $pdoSt->execute();
            } catch(\PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
                $_SESSION['errors']['BDD'] = 'Il y a eu une erreur lors de la connexion à la base de données';
            }
            $pdoSt = $pdo->prepare('INSERT INTO author_book(author_id, book_id) VALUES(:authorId, :bookId)');
            $pdoSt->bindValue(':bookId', $pdo->lastInsertId());
            $pdoSt->bindValue(':authorId', $bookAuthor);
            try {
                $pdoSt->execute();
            } catch(\PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
                $_SESSION['errors']['BDD'] = 'Il y a eu une erreur lors de la connexion à la base de données';
            }
        }
    }


    public function updateBook($bookId, $bookTitle, $bookSummary, $bookIsbn, $bookPages, $bookDate, $bookLanguage, $bookGenre, $bookAuthor, $authorBookId)
    {
        $pdo = $this->connectDB();
        if($pdo) {
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $pdoSt = $pdo->prepare('UPDATE books SET title = :bookTitle, summary = :bookSummary, isbn = :bookIsbn, npages = :bookPages, datepub = :bookDate, language_id = :bookLanguage, genre_id = :bookGenre WHERE id = :bookId');
            $pdoSt->bindValue(':bookId', $bookId);
            $pdoSt->bindValue(':bookTitle', $bookTitle);
            $pdoSt->bindValue(':bookSummary', $bookSummary);
            $pdoSt->bindValue(':bookIsbn', $bookIsbn);
            $pdoSt->bindValue(':bookPages', $bookPages);
            $pdoSt->bindValue(':bookDate', $bookDate);
            $pdoSt->bindValue(':bookLanguage', $bookLanguage);
            $pdoSt->bindValue(':bookGenre', $bookGenre);
            try {
                $pdoSt->execute();
            } catch(\PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
                $_SESSION['errors']['BDD'] = 'Il y a eu une erreur lors de la connexion à la base de données';
            }
            $pdoSt = $pdo->prepare('UPDATE author_book SET author_id = :authorId, book_id = :bookId WHERE author_book.id = :authorBookId');
            $pdoSt->bindValue(':bookId', $bookId);
            $pdoSt->bindValue(':authorId', $bookAuthor);
            $pdoSt->bindValue(':authorBookId', $authorBookId);
            try {
                $pdoSt->execute();
            } catch(\PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
                $_SESSION['errors']['BDD'] = 'Il y a eu une erreur lors de la connexion à la base de données';
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

    public function checkInfoLength($info)
    {
        return strlen($info) <= 255;
    }

    public function checkAuthor($author)
    {
        $pdo = $this->connectDB();
        if($pdo) {
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $pdoSt = $pdo->prepare('SELECT * FROM authors WHERE id = :id');
            $pdoSt->bindValue(':id', $author);
            try {
                $pdoSt->execute();
                return $pdoSt->fetch();
            } catch(\PDOException $e) {
                die('Connection failed: ' . $e);
                $_SESSION['errors']['BDD'] = 'Il y a eu une erreur lors de la connexion à la base de données';
            }
        }
    }

    public function checkGenre($genre)
    {
        $pdo = $this->connectDB();
        if($pdo) {
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $pdoSt = $pdo->prepare('SELECT * FROM genres WHERE id = :id');
            $pdoSt->bindValue(':id', $genre);
            try {
                $pdoSt->execute();
                return $pdoSt->fetch();
            } catch(\PDOException $e) {
                die('Connection failed: ' . $e);
                $_SESSION['errors']['BDD'] = 'Il y a eu une erreur lors de la connexion à la base de données';
            }
        }
    }

    public function checkLanguage($language)
    {
        $pdo = $this->connectDB();
        if($pdo) {
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $pdoSt = $pdo->prepare('SELECT * FROM languages WHERE id = :id');
            $pdoSt->bindValue(':id', $language);
            try {
                $pdoSt->execute();
                return $pdoSt->fetch();
            } catch(\PDOException $e) {
                die('Connection failed: ' . $e);
                $_SESSION['errors']['BDD'] = 'Il y a eu une erreur lors de la connexion à la base de données';
            }
        }
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

    public function getResults($title = null, $author = null, $genre = null, $language = null)
    {
        $bindValues = [];
        $requestParts = ['books.title LIKE :title', 'authors.name LIKE :author', 'genres.id = :genre_id', 'languages.id = :language_id'];
        $possibleBindValues = [[':title' => "%$title%"], [':author' => "%$author%"], [':genre_id' => $genre], [':language_id' => $language]];
        $request = 'SELECT books.title AS title, books.id AS bookId, authors.name AS author FROM books JOIN author_book ON books.id = author_book.book_id JOIN authors ON authors.id = author_book.author_id JOIN genres ON genres.id = books.genre_id JOIN languages ON languages.id = books.language_id';
        $hasArgs = false;

        foreach(func_get_args() as $argument) {
            if($argument) {
                $hasArgs = true;
            }
        }

        if($hasArgs) {
            $request .= ' WHERE';
        }

        $pdo = $this->connectDB();
        if($pdo) {
            foreach(func_get_args() as $index => $argument) {
                if($argument) {
                    $request .= ' ' . $requestParts[$index] . ' AND';
                    $bindValues[array_keys($possibleBindValues[$index])[0]] = $possibleBindValues[$index][array_keys($possibleBindValues[$index])[0]];
                }
            }
            if($hasArgs) {
                $request = substr($request, 0, -4);
            }

            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $pdoSt = $pdo->prepare($request);
            try {
                $pdoSt->execute($bindValues);
            } catch(\PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
            return $pdoSt->fetchAll();
        } else {
            die('Erreur de connexion à la base de données');
        }
    }

    public function delete($book_id)
    {
        $pdo = $this->connectDB();
        if($pdo) {
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $request = 'DELETE FROM author_book WHERE book_id = :book_id';
            $pdoSt = $pdo->prepare($request);
            try {
                $pdoSt->execute([':book_id' => $book_id]);
            } catch(\PDOException $e) {
                die('Connection error: ' . $e->getMessage());
            }

            $request = 'DELETE FROM books WHERE id = :book_id';
            $pdoSt = $pdo->prepare($request);
            try {
                $pdoSt->execute([':book_id' => $book_id]);
            } catch(\PDOException $e) {
                die('Connection error: ' . $e->getMessage());
            }


        }
    }
}