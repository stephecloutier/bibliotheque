<?php
namespace Controller;

use \Model\Auth as modelLogin;
class Auth {
    public function postLogin()
    {
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

    public function getLogout()
    {
        if(ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', 1,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }
        session_destroy();
        header('Location: ' . LOCAL_PATH);
        exit;
    }
}