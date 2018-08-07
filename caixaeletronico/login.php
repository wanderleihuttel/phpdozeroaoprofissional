<?php
session_start();
require_once('config.php');

print_r($_POST);

if( isset($_POST['agencia'])  && !empty($_POST['agencia']) ){

    $agencia = addslashes($_POST['agencia']);
    $conta   = addslashes($_POST['conta']);
    $senha   = md5(addslashes($_POST['senha']));

    $sql = "SELECT * FROM contas WHERE agencia = :agencia and conta = :conta and senha = :senha";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":agencia", $agencia);
    $stmt->bindValue(":conta", $conta);
    $stmt->bindValue(":senha", $senha);
    $stmt->execute();

    if( $stmt->rowCount() > 0 ){
        $row = $stmt->fetch();
        $_SESSION['banco'] = $row['id'];
        header("Location: index.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Caixa Eletrônico</title>
</head>
<body>
    <form method="POST">
        Agencia: </br>
        <input type="text" name="agencia"><br/><br/>
        Conta: </br>
        <input type="text" name="conta"><br/><br/>
        Senha: </br>
        <input type="password" name="senha"></br/><br/>
        <input type="submit" value="Entrar">

    </form>
</body>
</html>