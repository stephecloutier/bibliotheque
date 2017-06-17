<?php
namespace Model;

class Auth extends Model {
    private function getUser($email)
    {
        $pdo = $this->connectDB();
        $pdoSt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $pdoSt->bindValue(':email', $email);
        //$pdoSt->bindValue(':password', $password);
        $pdoSt->execute();
        return $pdoSt->fetch();
    }
    private function checkEmail($user)
    {
        if($user) {
            return true;
        }
        return false;
    }
    private function checkPassword($user, $password)
    {
        $password = hash('sha256', $password);
        if($user['password'] == $password){
            return true;
        }
        return false;
    }

    public function connectUser($email, $password)
    {
        $user = $this->getUser($email);
        $isEmailCorrect = $this->checkEmail($user);
        $isPasswordCorrect = $this->checkPassword($user, $password);
        if(!$isEmailCorrect) {
            return ['error' => ['email' => 'Il y a une erreur dans votre email.']];
        }
        if(!$isPasswordCorrect) {
            return ['error' => ['password' => 'Il y a une erreur dans votre mot de passe.']];
        }
        return $user;
    }
}