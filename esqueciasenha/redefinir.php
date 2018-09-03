<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Esqueci a senha</title>
    <link rel="stylesheet" href="bootstrap.min.css" >
</head>
<body>
<?php
require_once('config.php');

if( isset($_GET['token']) && !empty($_GET['token']) ){
    $token   = addslashes($_GET['token']);
    $expired = date('Y-m-d H:i:s');

    $sql = "SELECT * FROM usuarios_token WHERE token = :token AND used = 0 AND expired > :expired";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':token', $token);
    $stmt->bindValue(':expired', $expired);
    $stmt->execute();

    if( $stmt->rowCount()>0 ){
        $row = $stmt->fetch();
        $id = $row['usuario_id'];

        if( isset($_POST['senha']) && !empty($_POST['senha']) && 
            isset($_POST['confirmar_senha']) && !empty($_POST['confirmar_senha']) ) {

            $senha = addslashes($_POST['senha']);
            $confirmar_senha = addslashes($_POST['confirmar_senha']);

            if( $senha != $confirmar_senha){
                echo "As senhas não conferem!<br/>Digite novamente!";
            } else {
                $sql = "UPDATE usuarios SET senha = :senha WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':senha', $senha );
                $stmt->bindValue(':id', $id );
                $stmt->execute();
                
                $sql = "UPDATE usuarios_token SET used = 1 WHERE token = :token";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':token', $token);
                $stmt->execute();

                echo "Sua senha foi atualizada com sucesso!";
            }
        }
     ?>
    <div class="container">
        <div class="row">
            <h3>Redefinir senha</h3>
        </div>        
        <div class="row">
            <form method="POST">
              <div class="form-group">
                <label for="senha"></label>
                <input type="password" name="senha" class="form-control form-control-sm" placeholder="Digite sua senha...">
              </div>
              <div class="form-group">
                <label for="confirmar_senha"></label>
                <input type="password" name="confirmar_senha" class="form-control form-control-sm" placeholder="Confirme a sua senha...">
              </div>
              <button type="submit" class="btn btn-sm btn-primary">Enviar</button>
            </form>            
        </div>
    </div>
    <?php 
    } else {
        echo "Token expirado ou já utilizado!";
    }
}
?>
    <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
    <script type="text/javascript"src="popper.min.js"></script>
    <script type="text/javascript" src="bootstrap.min.js"></script>  
</body>
</html>