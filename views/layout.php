<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <title>Bibliothèque</title>
</head>
<body>
    <h1>Bibliothèque</h1>
    <header>
        <?php
            if(!isset($_SESSION['user'])){
                include 'parts/logoutNav.php';
            } else {
                include 'parts/loginNav.php';
            }
        ?>
    </header>
    <main>
        <?php foreach($datas['view'] as $part){
            include $part;
        }
        ?>
    </main>

 <footer>
     <p>Designed and developed by <a href="http://stephanie.cloutier.pro">Stéphanie Cloutier</a></p>
 </footer>
</body>
</html>