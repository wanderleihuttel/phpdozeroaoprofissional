<?php
    if ( isset($_SESSION['cLogin']) && !(empty($_SESSION['cLogin']))){
        $usuario = new Usuario();
        $usuario_logado = $usuario->getUserNameById($_SESSION['cLogin']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Classificados MVC</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="<?php echo BASE_URL; ?>" class="navbar-brand">Classificados</a>
            </div>
            <div class="navbar-collapse collapse justify-content-between">
                <ul class="navbar-nav ml-auto">
                    <?php  if ( isset($_SESSION['cLogin']) && !(empty($_SESSION['cLogin']))) : ?>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <strong>Usuário: </strong><?php echo $usuario_logado; ?>
                      </a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>/anuncio">Meus anúncios</a>
                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>/login/sair">Sair</a>
                      </div>
                    </li>
                    <?php else:?>
                    <li class="nav-item"><a href="<?php echo BASE_URL; ?>/cadastro" class="nav-link">Cadastrar</a></li>
                    <li class="nav-item"><a href="<?php echo BASE_URL; ?>/login" class="nav-link">Entrar</a></li>
                    <?php endif;?>
                </ul>
            </div>
        </div>
    </nav>
    <?php $this->loadViewInTemplate($viewName, $viewData); ?>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>



