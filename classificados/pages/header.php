<?php
require_once("config.php");
require_once('classes/usuario.php');

if ( isset($_SESSION['cLogin']) && !(empty($_SESSION['cLogin']))){
    $usuario_logado = Usuario::getUserNameById($_SESSION['cLogin']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Classificados</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="./" class="navbar-brand">Classificados</a>
            </div>
            <div class="navbar-collapse collapse justify-content-between">
                <ul class="navbar-nav ml-auto">
                    <?php  if ( isset($_SESSION['cLogin']) && !(empty($_SESSION['cLogin']))) : ?>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><strong>Usuário: </strong><?php echo $usuario_logado; ?></a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="meus-anuncios.php">Meus anúncios</a>
                        <a class="dropdown-item" href="sair.php">Sair</a>
                      </div>
                    </li>

                    <?php else:?>
                    <li class="nav-item"><a href="cadastro.php" class="nav-link">Cadastrar</a></li>
                    <li class="nav-item"><a href="login.php" class="nav-link">Entrar</a></li>
                    <?php endif;?>
                </ul>
            </div>
        </div>
    </nav>