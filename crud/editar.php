<?php
require_once("contato.php");
$contato = new Contato();

if(isset($_GET['id'])){
  $id = addslashes($_GET['id']);
  $info = $contato->getInfo($id);
  
  if(empty($info['email'])){
    header("Location: index.php");
    exit;
  }

} 

if ( isset($_POST['email']) && !empty($_POST['email'])){
    $id = addslashes($_POST['id']);
    $nome = addslashes($_POST['nome']);

    if($contato->editar($id, $nome)){
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
            <h3>Editar Usuário</h3>            
        </div>
        <div class="row">
            <form method="POST">
              <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                <input type="text" name="nome" class="form-control form-control-sm" placeholder="Digite o seu nome..." value="<?php echo $info['nome']; ?>">
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="text"  readonly name="email" class="form-control-plaintext font-weight-bold" placeholder="Digite o seu email..." value="<?php echo $info['email']; ?>">
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