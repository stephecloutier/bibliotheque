<?php
namespace Controller;
use \Model\Model as Model;
use \Model\Book as BookModel;

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
        $model = new Model;
        $datas['view'] = ['parts/advancedSearch.php'];
        $datas['genres'] = $model->getGenres();
        $datas['languages'] = $model->getLanguages();
        return $datas;
    }

    public function bookUpdate()
    {
        $bookModel = new BookModel;
        $model = new Model;

        $datas['book'] = $bookModel->getSingleBook($_GET['bookId']);
        $datas['authors'] = $model->getAuthors();
        $datas['genres'] = $model->getGenres();
        $datas['languages'] = $model->getLanguages();

        if(isset($_SESSION['user']) && intval($_SESSION['user']['status']) === 1) {
            $datas['view'] = ['parts/update-single-book.php'];
            return $datas;
        } else {
            $datas['view'] = ['parts/single-book.php'];
            return $datas;
        }
    }
}