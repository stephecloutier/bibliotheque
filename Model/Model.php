<?php
namespace Model;

class Model {
    protected function connectDB ()
    {
        $dsn = '';
        $db_config = ['username' => '', 'password' => ''];

        if(file_exists(INI_FILE)){
            $db_config = parse_ini_file(INI_FILE);
            $dsn = sprintf('%s:dbname=%s;host=%s', $db_config['driver'], $db_config['dbname'], $db_config['host']);
        }
        try {
            return new \PDO(
                $dsn,
                $db_config['username'],
                $db_config['password']
            );
        } catch(\PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public function isUserConnected()
    {
        return isset($_SESSION['user']);
    }

    public function getAuthors()
    {
        $pdo = $this->connectDB();
        if($pdo) {
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $pdoSt = $pdo->prepare('SELECT id, name FROM authors');
            try {
                $pdoSt->execute();
                return $pdoSt->fetchAll();
            } catch(\PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
                $_SESSION['errors']['BDD'] = 'Il y a eu une erreur lors de la connexion à la base de données';
            }
        }
        die('Connection to db failed');
        $_SESSION['errors']['BDD'] = 'Il y a eu une erreur lors de la connexion à la base de données';
    }

    public function getGenres()
    {
        $pdo = $this->connectDB();
        if($pdo) {
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $pdoSt = $pdo->prepare('SELECT id, name FROM genres');
            try {
                $pdoSt->execute();
                return $pdoSt->fetchAll();
            } catch(\PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
        }
        die('Connection to db failed');
        $_SESSION['errors']['BDD'] = 'Il y a eu une erreur lors de la connexion à la base de données';
    }

    public function getLanguages()
    {
        $pdo = $this->connectDB();
        if($pdo) {
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $pdoSt = $pdo->prepare('SELECT id, name FROM languages');
            try {
                $pdoSt->execute();
                return $pdoSt->fetchAll();
            } catch(\PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
                $_SESSION['errors']['BDD'] = 'Il y a eu une erreur lors de la connexion à la base de données';
            }
        }
        die('Connection to db failed');
        $_SESSION['errors']['BDD'] = 'Il y a eu une erreur lors de la connexion à la base de données';
    }


    public function checkField($field)
    {
        if($field === '') {
            $field = null;
        }
        return $field;
    }

    public function validateDate($date,  $format = 'd-m-Y')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
}