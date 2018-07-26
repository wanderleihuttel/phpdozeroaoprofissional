<?php
session_start();

if( isset($_SESSION['id']) && !empty($_SESSION['id'])){
    // go on
} else {
    echo "index.php";
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Área Restrita</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="pure-menu pure-menu-horizontal">
        <a href="#" class="pure-menu-heading"><img src="php.png" height="25"/></a>
        <ul class="pure-menu-list">
            <li class="pure-menu-item"><a href="#" class="pure-menu-link">Home</a></li>
            <li class="pure-menu-item"><a href="#" class="pure-menu-link">Contato</a></li>
            <li class="pure-menu-item "><a href="logout.php" class="pure-menu-link">Logout</a></li>
        </ul>
        <div class="usuario-logado"> Usuário: <strong><?php echo $_SESSION['nome']; ?></strong></div>
    </div>
    <div class="content-wrap">
        <div class="content">
            <h1>Você está acessando uma área restrita!</h1>
        </div>
    </div>
</body>
</html>