<?php
require_once("contato.php");
$contato = new Contato();

if( isset($_POST['email']) && !empty($_POST['email'])){
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);

    if($contato->adicionar($email, $nome)){
        header("Location: index.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-with,initial-scale=1, shrink-to-fit=no" />
    <title>CRUD - Módulo 12 - PHP Avançado</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" >
</head>
<body>
    <div class="container">
        <div class="row">
            <h3>Adicionar Usuário</h3>            
        </div>
        <div class="row">
            <form method="POST">
              <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" class="form-control"  placeholder="Digite o seu nome...">
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" placeholder="Digite o seu email...">
              </div>
              <button type="submit" class="btn btn-sm btn-primary">Salvar</button>
              <a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
            </form>            
        </div>
    </div>
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript"src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>   
</body>
</html>