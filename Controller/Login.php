<?php
namespace Controller;

use \Model\Login as modelLogin;
class Login {
    public function postLogin() {
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $login = new modelLogin;
            $user =  $login->connectUser($_POST['email'], $_POST['password']);
            if(isset($user['error'])) {
                $datas['error'] = $user['error'];
            }
            $_SESSION['user'] = $user;
            $datas['view'] = ['parts/basicSearch.php', 'parts/news.php', 'parts/suggestions.php'];
        } else {
            $datas['error'] = ['email' => 'Vous n’avez pas entré une adresse email valide'];
            $datas['view'] = ['parts/login.php'];
        }
        return $datas;
    }
}