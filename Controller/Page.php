<?php
namespace Controller;
use \Model\Model as Model;

class Page {
    public function summary() {
        if(isset($_SESSION['user'])) {
            $datas['view'] = ['parts/basicSearch.php', 'parts/news.php', 'parts/suggestions.php'];
        } else {
            $datas['view'] = ['parts/basicSearch.php', 'parts/news.php'];
        }
        return $datas;
    }

    public function getLogin() {
        $datas['view'] = ['parts/login.php'];
        return $datas;
    }

    public function getAdmin() {
        if(!isset($_SESSION['user'])) {
            header('Location: '. LOCAL_PATH);
            $_SESSION['errors']['user'] = 'Vous devez être connecté pour accèder à cette page';
            exit;
        } else {
            if(intval($_SESSION['user']['status']) === 1) {
                $model = new Model;
                $datas['view'] = ['parts/admin.php'];
                $datas['authors'] = $model->getAuthors();
                $datas['genres'] = $model->getGenres();
                $datas['languages'] = $model->getLanguages();
                return $datas;
            } else {
                echo 'Petit malin, tu n’es pas administrateur et tu n’as rien à faire ici ! oust !';
                $datas['view'] = ['parts/basicSearch.php', 'parts/news.php', 'parts/suggestions.php'];
            }
        }
        return $datas;
    }

    public function advancedSearch() {
        $datas['view'] = ['parts/advancedSearch.php'];
        return $datas;
    }
}