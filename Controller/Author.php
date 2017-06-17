<?php
namespace Controller;

use \Model\Author as AuthorModel;

class Author {
    public function addAuthor() {
        $addAuthor = new AuthorModel;
        //$_POST['authorImg'], $_POST['authorBio'], $_POST['authorDeath']
        $addAuthor->addAuthor($_POST['authorName'], $_POST['authorBirth']);
        $datas['view'] = ['parts/admin.php'];
        return $datas;
    }
}