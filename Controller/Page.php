<?php
namespace Controller;

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
            // ajouter une erreur
            exit;
        } else {
            if(intval($_SESSION['user']['status']) === 1) {
                $datas['view'] = ['parts/admin.php'];
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