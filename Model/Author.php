<?php
namespace Model;

class Author extends Model {
    public function getAuthor($authorName)
    {
        $pdo = $this->connectDB();
        $pdoSt = $pdo->prepare('SELECT * FROM authors WHERE name = :authorName');
        $pdoSt->bindValue(':authorName', $authorName);
        $pdoSt->execute();
        return $pdoSt->fetch();
    }

    public function addAuthor($authorName, $birthDate, $photo = null, $bio = null, $deathDate = null)
    {
        $pdo = $this->connectDB();
        if($pdo) {
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $pdoSt = $pdo->prepare('INSERT INTO authors(name, photo, datebirth, datedeath, bio) VALUES(:authorName, :photo, :birthDate, :deathDate, :bio)');
            $pdoSt->bindValue(':authorName', $authorName);
            $pdoSt->bindValue(':photo', $photo);
            $pdoSt->bindValue(':birthDate', $birthDate);
            $pdoSt->bindValue(':deathDate', $deathDate);
            $pdoSt->bindValue(':bio', $bio);
            try {
                $pdoSt->execute();
            } catch(\PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
            return $pdo->lastInsertId();
        }
    }
}