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

            } catch(\PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
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
}