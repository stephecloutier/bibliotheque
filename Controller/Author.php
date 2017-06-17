<?php
namespace Controller;

use \Model\Author as AuthorModel;
use \Model\Model as Model;
use \Controller\Page as Page;

class Author {
    public function addAuthor() {
        $addAuthor = new AuthorModel;
        $page = new Page;
        $model = new Model;
        if(isset($_POST['authorName']) && isset($_POST['authorBirth'])) {
            $authorImg = $model->checkField($_POST['authorImg']);
            $authorBio = $model->checkField($_POST['authorBio']);
            $authorDeath = $model->checkField($_POST['authorDeath']);

            if(!$addAuthor->getAuthor($_POST['authorName'], $_POST['authorBirth'])) {
                $addAuthor->addAuthor($_POST['authorName'], $_POST['authorBirth'], $authorImg, $authorBio, $authorDeath);
                return $page->getAdmin();
            } else {
                die('Cet auteur existe deja dans la base de données');
                return['view' => ['parts/admin.php'], 'errors' => ['L’auteur entré existe déjà dans la base de donnée']];
            }
        } else {
            die('Vous devez entrer au minimum le nom de l’auteur et sa date de naissance');
            return['view' => ['parts/admin.php'], 'errors' => ['Vous devez entrer au minimum le nom de l’auteur et sa date de naissance']];
        }
    }
}