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

    public function advancedSearch() {
        $datas['view'] = ['parts/advancedSearch.php'];
        return $datas;
    }
}