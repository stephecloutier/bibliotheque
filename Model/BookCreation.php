<?php
namespace Model;

class BookCreation extends Model {
    public function addBookCover($file, $filename)
    {
        $feedback = '';
        if(!isset($file)) {
            return ['error' => 'Il y a eu une erreur lors de l’envoi de l’image'];
        }
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if(!in_array($file['type'], $allowedTypes)) {
            return ['error' => 'Le fichier envoyé n’est pas un jpeg ou un png'];
        }
        //$typeParts = explode('/', $file['type']);
        //$ext = '.' . $typeParts[count($typeParts) - 1];
        iconv($charset, 'ASCII//TRANSLIT//IGNORE', $str);
        $filename = str_replace([' ', '\''], '-', $filename);
        $dest = './files/' . $filename;
        // return url
    }
}