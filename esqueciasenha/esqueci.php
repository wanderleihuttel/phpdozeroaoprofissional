<?php
require_once('config.php');

if( isset($_POST['email']) && !empty($_POST['email'])){
    $email = addslashes($_POST['email']);

    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();

    if( $stmt->rowCount() > 0 ){
        $row = $stmt->fetch();
        $id = $row['id'];

        $token = md5( time() . rand(0,99999) . rand(0,99999));
        $expired = date('Y-m-d H:i', strtotime('+24 hours'));
        
        $sql = "INSERT INTO usuarios_token (usuario_id, token, expired) VALUES (:usuario_id, :token, :expired)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':usuario_id', $id);
        $stmt->bindValue(':token', $token);
        $stmt->bindValue(':expired', $expired);
        $stmt->execute();
        
        $link = "http://192.168.1.87/phpdozeroaoprofissional/esqueciasenha/redefinir.php?token={$token}";
        echo "Clique no link para redefinir sua senha.\n <a href='" . $link . "'>" . $link . "</a>";
        exit;
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Esqueci a senha</title>
    <link rel="stylesheet" href="bootstrap.min.css" >
</head>
<body>

    <div class="container">
        <div class="row">
            <h3>Esqueci a senha</h3>
        </div>
        <div class="row">
            <form method="POST">
              <div class="form-group">
                <label for="email"></label>
                <input type="email" name="email" class="form-control form-control-sm" placeholder="Digite o seu email...">
              </div>
              <button type="submit" class="btn btn-sm btn-primary">Enviar</button>
            </form>            
        </div>
    </div>
    
    <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
    <script type="text/javascript"src="popper.min.js"></script>
    <script type="text/javascript" src="bootstrap.min.js"></script>  

    
</body>
</html>


